<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\InvitationRequest;
use App\Jobs\SendInvitationMail;
use App\Models\Invitation;
use App\Models\Log;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
        $invites = $user->invitations()->where('accepted', '=', false)->get();
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

        $invite_days = setting('invite_days');

        //insere os dados no banco
        $invite = new Invitation();
        $invite->user_id = $user->id;
        $invite->email = $email;
        $invite->code = $code;
        $invite->expires_on = Carbon::now()->addDays($invite_days);
        $invite->save();

        //subtrai um "invite" de quem enviou o convite
        $user->invites -= 1;
        $user->save();

        //send email
        $this->dispatch(new SendInvitationMail($invite));

        // Log
        $this->log::record("Membro {$user->name} enviou um convite para {$email}");

        toastr()->success('Convite enviado com sucesso.', 'Sucesso');
        return redirect()->route('invites.index');
    }

}
