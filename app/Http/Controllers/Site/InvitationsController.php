<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\InvitationRequest;
use App\Mail\AccountInvitation;
use App\Models\Invitation;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class InvitationsController extends Controller
{
    private $log;

    public function __construct()
    {
        $this->middleware('auth');
        $this->log = new Log();
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $invites = $user->invitations()->where('is_accepted', '=', false)->get();
        return view('site.invites.index', compact('invites'));
    }

    public function store(InvitationRequest $request)
    {
        //membro que esta convidando
        $user = $request->user();
        //email de quem vai receber o convite
        $email = $request->input('email');
        //codigo enviado para o(a) convidado(a)
        $code = sha1_gen();

        $invitedays = setting('invitedays');

        //insere os dados no banco
        $invite = new Invitation();
        $invite->user_id = $user->id;
        $invite->email = $email;
        $invite->code = $code;
        $invite->expires_on = Carbon::now()->addDays($invitedays);
        $invite->save();

        //subtrai um "invite" de quem enviou o convite
        $user->invites -= 1;
        $user->save();

        //send email
        Mail::to($email)->send(new AccountInvitation($invite));

        // Log
        $this->log::record("Membro {$user->name} enviou um convite para {$email}");

        toastr()->success('Convite enviado com sucesso.', 'Sucesso');
        return redirect()->to('invites');
    }

    public function resend(Request $request, $invite_id)
    {
        $user = $request->user();
        $invite = Invitation::findOrFail($invite_id);

        abort_unless($invite->user_id === $user->id, 403);

        if ($invite->accepted_by !== null) {
            toastr()->error('O convite que você está tentando re-enviar já foi usado.', 'Aviso');
            return redirect()->route('invites');
        }

        Mail::to($invite->email)->send(new AccountInvitation($invite));

        // Log
        $this->log::record("Membro {$user->name} reenviou o convite para {$invite->email} .");

        toastr()->success('O convite foi reenviado com sucesso!', 'Aviso');
        return redirect()->route('invites');
    }
}
