<?php

namespace App\Http\Controllers;

use App\Models\Cheater;
use App\Models\Historic;
use App\Models\Peer;
use App\Models\Torrent;
use App\Torrent\Encoder;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnnounceController extends Controller
{
    /**
     * @param Request $request
     * @param string $passkey
     *
     * @return Response
     * @throws Exception
     */
    public function announce(Request $request, string $passkey)
    {
        //check for the request type
        $this->checkRequestType();

        //for log and debug
        //info($request->all());

        //user-agent em uso
        $agent = $request->userAgent();

        //blockeia acesso pelo browser
        $this->browserBlacklist($agent);

        //checa se a passkey nao esta nula
        if (empty($passkey)) {
            return $this->encodeMessage('Sem identificacao de usuario', 200);
        }
        //checa se a passkey eh diferente de 32 caracteres
        if (strlen($passkey) !== 32) {
            return $this->encodeMessage('Identificacao do usuario invalida', 200);
        }
        //checa se o Info Hash eh fornecido
        if (!$request->has('info_hash')) {
            return $this->encodeMessage('Identificacao de Hash invalida', 200);
        }
        //checa se o PeerID eh fornecido
        if (!$request->has('peer_id')) {
            return $this->encodeMessage('Identificacao do PeerId invalida', 200);
        }
        //checa se a porta eh fornecida
        if (!$request->has('port')) {
            return $this->encodeMessage('Identicacao da Porta invalida', 200);
        }
        //checa se o 'Left' eh fornecido
        if (!$request->has('left')) {
            return $this->encodeMessage('Identicacao do Left invalida', 200);
        }
        //checa se o 'Uploaded' eh fornecido
        if (!$request->has('uploaded')) {
            return $this->encodeMessage('Identicacao de Upload invalidp', 200);
        }
        //checa se o 'Downloaded' eh fornecido
        if (!$request->has('downloaded')) {
            return $this->encodeMessage('Identicacao de Downloaded invalido', 200);
        }

        //select the current in the database
        $user = User::with('vips')
            ->select('id', 'downloaded', 'max_slots', 'passkey', 'status', 'uploaded')
            ->where('passkey', '=', $passkey)->first();

        //caso usuario nao exista
        if (!$user) {
            return $this->encodeMessage('Identificacao do usuario invalida', 200);
        }
        //checa se o usuario esta banido
        if ($user->status == 3) {
            return $this->encodeMessage('Conta Banida', 200);
        }
        //checa se o usuario esta suspenso
        if ($user->status == 2) {
            return $this->encodeMessage('Conta Suspensa', 200);
        }
        //checa se o usuario esta banido
        if ($user->status == 0) {
            return $this->encodeMessage('Conta Pendente Ativacao', 200);
        }

        //clean peer_id for blacklist check
        $peerId = $request->input('peer_id');
        $port = (int)$request->input('port');

        // Checa se o programa que o usuario esta usando é permitido
        $this->peerBlacklist($peerId, $user->id, $port, $agent);

        //checa se a porta é BlackListed
        $this->portBlacklist($port);

        //Informacoes Padroes
        $info_hash = bin2hex($request->input('info_hash'));
        $peer_id = bin2hex($peerId);
        $md5_peer_id = md5($peer_id);
        $uploaded = (float)$request->input('uploaded');
        $real_uploaded = $uploaded;
        $downloaded = (float)$request->input('downloaded');
        $real_downloaded = $downloaded;
        $left = (float)$request->input('left');
        $event = $request->input('event');
        $ip = $request->ip();

        //Informacoes adicionais
        $tracker_id = $request->has('trackerid') ? $request->input('trackerid') : $md5_peer_id;
        $compact = ($request->has('compact') && $request->input('compact') == 1) ? true : false;
        $no_peer_id = ($request->has('no_peer_id') && $request->input('no_peer_id') == 1) ? true : false;
        $numwanted = (int)$request->has('numwant') ? (int)$request->input('numwant') : 50;
        $key = $request->has('key') ? bin2hex($request->input('key')) : null;

        if (!$compact) {
            return $this->encodeMessage('Seu programa nao suporta compact, atualize seu programa', 200);
        }

        // Se o cliente do usuário está enviando valores negativos Retornar erro ao cliente
        if ($uploaded < 0 || $downloaded < 0 || $left < 0) {
            return $this->encodeMessage('Dados do cliente estao negativo. Reinicie seu programa', 200);
        }

        //seleciona o torrent no DB
        $torrent = Torrent::with('peers', 'completes')
            ->select('id', 'times_completed', 'seeders', 'leechers', 'is_freeleech', 'is_silver', 'is_doubleup', 'vip_first')
            ->where('info_hash', '=', $info_hash)
            ->first();

        //se Torrent não existe retorna erro
        if (!$torrent || $torrent->id < 0) {
            return $this->encodeMessage('Torrent nao encontrado', 200);
        }

        //seleciona os peers no DB
        $peers = Peer::where('torrent_id', '=', $torrent->id)->take($numwanted)->get()->toArray();

        // Limite de torrent por vez baixando
        $limit = Peer::where('user_id', '=', $user->id)->where('is_leecher', '=', true)->count();

        //se o usuario excedeu o limite volta mensagem
        if ($limit > $user->max_slots) {
            return $this->encodeMessage('Voce atingiu seu o limite de download simultaneo', 200);
        }

        // Pega os peers atuais
        $client = Peer::where('torrent_id', '=', $torrent->id)->where('user_id', '=', $user->id)->first();

        //O sinalizador é desarmado se uma nova sessão for criada, mas os relatórios do cliente para up/down > 0
        $ghost = false;

        // Cria um novo cliente, se não existente
        if (!$client && $event == 'completed') {
            return $this->encodeMessage('Torrent esta completo, mas nenhum registro foi encontrado', 200);
        } elseif (!$client) {
            if ($uploaded > 0 || $downloaded > 0) {
                $ghost = true;
                $event = 'started';
            }
            $client = new Peer();
        }

        //Pega informacoes do Historico
        $historic = Historic::where('info_hash', '=', $info_hash)->where('user_id', '=', $user->id)->first();

        if (!$historic) {
            $historic = new Historic();
            $historic->torrent_id = $torrent->id;
            $historic->user_id = $user->id;
            $historic->info_hash = $info_hash;
        }

        if ($ghost) {
            $uploaded = ($real_uploaded >= $historic->real_uploaded) ? ($real_uploaded - $historic->real_uploaded) : 0;
            $downloaded = ($real_downloaded >= $historic->real_downloaded) ? ($real_downloaded - $historic->real_downloaded) : 0;
        } else {
            $uploaded = ($real_uploaded >= $client->uploaded) ? ($real_uploaded - $client->uploaded) : 0;
            $downloaded = ($real_downloaded >= $client->downloaded) ? ($real_downloaded - $client->downloaded) : 0;
        }

        //update seed_time
        $old_update = $client->updated_at ? $client->updated_at->timestamp : Carbon::now()->timestamp;

        //checa se o usuario tem direitos de VIP
        $is_vip = $user->vips()->where('user_id', '=', $user->id)->where('is_active', '=', true)->first();

        //modifica o upload ou download
        if (!$is_vip) {
            //Freeleech
            $mod_down = $torrent->is_freeleech == true ? 0 : $downloaded;
            //Silver
            $mod_downloaded = $torrent->is_silver == true ? ($downloaded / 2) : $downloaded;
            //DoubleUP
            $mod_upload = $torrent->is_doubleup == true ? ($uploaded * 2) : $uploaded;
            //Modded Download
            $mod_download = $mod_down ?: $mod_downloaded;
        } else {
            //Freeleech
            $mod_down = $is_vip->is_freeleech == true ? 0 : $downloaded;
            //Silver
            $mod_downloaded = $is_vip->is_silver == true ? ($downloaded / 2) : $downloaded;
            //DoubleUP
            $mod_upload = $is_vip->is_doubleup == true ? ($uploaded * 2) : $uploaded;
            //Modded Download
            $mod_download = $mod_down ?: $mod_downloaded;
        }

        if ($event == 'started') {
            //historic
            $historic->client = $agent;
            $historic->uploaded += 0;
            $historic->mod_uploaded += 0;
            $historic->real_uploaded = $real_uploaded;
            $historic->downloaded += 0;
            $historic->mod_downloaded += 0;
            $historic->real_downloaded = $real_downloaded;
            $historic->is_seeder = ($left == 0) ? true : false;
            $historic->is_leecher = ($left > 0) ? true : false;
            $historic->is_active = true;
            $historic->is_released = ($is_vip) ? true : false;
            $historic->save();

            //Peer data
            $client->torrent_id = $torrent->id;
            $client->user_id = $user->id;
            $client->md5_peer_id = $md5_peer_id;
            $client->peer_id = $peer_id;
            $client->ip = $ip;
            $client->client = $agent;
            $client->is_seeder = ($left == 0) ? true : false;
            $client->is_leecher = ($left > 0) ? true : false;
            $client->port = $port;
            $client->uploaded = $real_uploaded;
            $client->downloaded = $real_downloaded;
            $client->remaining = $left;
            $client->save();

        } elseif ($event == 'completed') {
            //historic
            $historic->client = $agent;
            $historic->uploaded += $uploaded;
            $historic->mod_uploaded += $mod_upload;
            $historic->real_uploaded = $real_uploaded;
            $historic->downloaded += $downloaded;
            $historic->mod_downloaded += $mod_download;
            $historic->real_downloaded = $real_downloaded;
            $historic->is_seeder = ($left == 0) ? true : false;
            $historic->is_leecher = ($left > 0) ? true : false;
            $historic->is_active = true;
            $historic->is_released = ($is_vip) ? true : false;
            $historic->completed_at = now();
            $historic->update();

            //Peer data
            $client->torrent_id = $torrent->id;
            $client->user_id = $user->id;
            $client->md5_peer_id = $md5_peer_id;
            $client->peer_id = $peer_id;
            $client->ip = $ip;
            $client->client = $agent;
            $client->is_seeder = ($left == 0) ? true : false;
            $client->is_leecher = ($left > 0) ? true : false;
            $client->port = $port;
            $client->uploaded = $real_uploaded;
            $client->downloaded = $real_downloaded;
            $client->remaining = 0;
            $client->update();

            //User data
            $user->uploaded += $mod_upload;
            $user->downloaded += $mod_download;
            $user->update();

            //Torrent update
            $torrent->times_completed += 1;

            //salva no banco como download completo
            $torrent->completes()->create(['user_id' => $user->id]);

            //Seedtime
            $new_update = $client->updated_at->timestamp;
            $diff = $new_update - $old_update;
            $historic->seed_time += $diff;
            $historic->update();

        } elseif ($event == 'stopped') {
            //historic
            $historic->client = $agent;
            $historic->uploaded += $uploaded;
            $historic->mod_uploaded += $mod_upload;
            $historic->real_uploaded = $real_uploaded;
            $historic->downloaded += $downloaded;
            $historic->mod_downloaded += $mod_download;
            $historic->real_downloaded = $real_downloaded;
            $historic->is_seeder = ($left == 0) ? true : false;
            $historic->is_leecher = ($left > 0) ? true : false;
            $historic->is_active = false;
            $historic->is_released = ($is_vip) ? true : false;
            $historic->update();

            //Peer data
            $client->torrent_id = $torrent->id;
            $client->user_id = $user->id;
            $client->md5_peer_id = $md5_peer_id;
            $client->peer_id = $peer_id;
            $client->ip = $ip;
            $client->client = $agent;
            $client->is_seeder = ($left == 0) ? true : false;
            $client->is_leecher = ($left > 0) ? true : false;
            $client->port = $port;
            $client->uploaded = $real_uploaded;
            $client->downloaded = $real_downloaded;
            $client->remaining = $left;
            $client->update();

            //user update
            $user->uploaded += $mod_upload;
            $user->downloaded += $mod_download;
            $user->update();

            // Seedtime allocation
            if ($left == 0) {
                $new_update = $client->updated_at->timestamp;
                $diff = $new_update - $old_update;
                $historic->seed_time += $diff;
                $historic->update();
            }

            $client->delete();
        } else {
            // Set the torrent data
            $historic->client = $agent;
            $historic->uploaded += $uploaded;
            $historic->mod_uploaded += $mod_upload;
            $historic->real_uploaded = $real_uploaded;
            $historic->downloaded += $downloaded;
            $historic->mod_downloaded += $mod_download;
            $historic->real_downloaded = $real_downloaded;
            $historic->is_seeder = ($left == 0) ? true : false;
            $historic->is_leecher = ($left > 0) ? true : false;
            $historic->is_active = true;
            $historic->save();

            //Peer data
            $client->torrent_id = $torrent->id;
            $client->user_id = $user->id;
            $client->md5_peer_id = $md5_peer_id;
            $client->peer_id = $peer_id;
            $client->ip = $ip;
            $client->client = $agent;
            $client->is_seeder = ($left == 0) ? true : false;
            $client->is_leecher = ($left > 0) ? true : false;
            $client->port = $port;
            $client->uploaded = $real_uploaded;
            $client->downloaded = $real_downloaded;
            $client->remaining = $left;
            $client->save();

            //User update
            $user->uploaded += $mod_upload;
            $user->downloaded += $mod_download;
            $user->update();

            // Seedtime allocation
            if ($left == 0) {
                $new_update = $client->updated_at->timestamp;
                $diff = $new_update - $old_update;
                $historic->seed_time += $diff;
                $historic->update();
            }
        }

        $torrent->seeders = $torrent->peers()->where('torrent_id', '=', $torrent->id)->where('remaining', '=', 0)->count();
        $torrent->leechers = $torrent->peers()->where('torrent_id', '=', $torrent->id)->where('remaining', '>', 0)->count();
        $torrent->update();

        $response = [
            'interval' => config('announce.time.interval'),
            'min interval' => config('announce.time.min_interval'),
            'tracker id' => $tracker_id,
            'private' => 1,
            'complete' => (int)$torrent->seeders,
            'incomplete' => (int)$torrent->leechers,
            'peers' => $this->givePeersIPV4($peers, $compact, $no_peer_id),
            'peers6' => $this->givePeersIPV6($peers, $compact, $no_peer_id),
        ];

        return response(Encoder::encode($response), 200)->withHeaders(['Content-Type' => 'text/plain']);
    }

    /**
     * @return Response
     */
    private function checkRequestType()
    {
        if (request()->method() !== 'GET') {
            info('O metodo de solicitacao de Request nao foi GET. IP: ' . request()->ip());
            return $this->encodeMessage('Tipo de request invalida', 200);
        }
    }

    /**
     * @param string $message
     * @param int $status
     * @return Response
     */
    private function encodeMessage($message, $status)
    {
        return response(Encoder::encode(['failure reason' => $message]), $status)->withHeaders(['Content-Type' => 'text/plain']);
    }

    private function browserBlacklist($agent)
    {
        $browsers = config('announce.browsers');

        if (in_array($agent, $browsers)) {
            info('Tentativa de announce com navegador: ' . request()->ip());
            abort(405, 'Hmm, peguei no flagra.');
            exit();
        }
    }

    private function peerBlacklist($peer_id, $user_id, $port, $agent)
    {
        $programs = config('announce.peers');

        $peer = substr($peer_id, 0, 8);
        $ip = request()->ip();

        foreach ($programs as $key => $program) {
            if (stripos($peer, $program) !== false) {
                //save in DB
                $cheat = new Cheater();
                $cheat->user_id = $user_id;
                $cheat->port = $port;
                $cheat->ip = $ip;
                $cheat->program = $agent;
                $cheat->is_blacklist = true;
                $cheat->save();

                //log info
                info('Usuario tentou utilizar programa bloqueado. IP: ' . $ip);
                abort(500);
                return $this->encodeMessage('Programa ou versao desatualizada', 401);
            }
        }
    }

    private function portBlacklist($port)
    {
        $blocked = config('announce.ports');

        if (in_array($port, $blocked)) {
            //info('Tentativa de conectar-se usando porta bloqueada: ' . request()->ip());
            return $this->encodeMessage('Porta na lista negra. Troque de porta', 200);
        }
    }

    /**
     * @param $peers
     * @param $compact
     * @param $no_peer_id
     * @return string
     */
    private function givePeersIPV4($peers, $compact, $no_peer_id)
    {
        return $this->giver($peers, $compact, $no_peer_id, true);
    }

    /**
     * @param $peers
     * @param $compact
     * @param $no_peer_id
     * @param bool $ipv4
     * @return string
     */
    private function giver($peers, $compact, $no_peer_id, bool $ipv4 = true): string
    {
        if ($compact) {
            $pcomp = '';
            foreach ($peers as &$peer) {
                if (isset($peer['ip']) && isset($peer['port'])) {
                    if ($ipv4 == true) {
                        if (filter_var($peer['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                            $pcomp .= inet_pton($peer['ip']);
                            $pcomp .= pack('n', (int)$peer['port']);
                        }
                    } else {
                        if (filter_var($peer['ip'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
                            $pcomp .= inet_pton($peer['ip']);
                            $pcomp .= pack('n', (int)$peer['port']);
                        }
                    }
                }
            }
            return $pcomp;
        } elseif ($no_peer_id) {
            foreach ($peers as &$peer) {
                unset($peer['peer_id']);
            }
            return $peers;
        } else {
            return $peers;
        }
    }

    /**
     * @param $peers
     * @param $compact
     * @param $no_peer_id
     * @return string
     */
    private function givePeersIPV6($peers, $compact, $no_peer_id)
    {
        return $this->giver($peers, $compact, $no_peer_id, false);
    }
}
