<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\UserBannedRequest;
use App\Http\Requests\Staff\UserNotesRequest;
use App\Http\Requests\Staff\UserSuspendedRequest;
use App\Http\Requests\Staff\UserUpdatesRequest;
use App\Http\Requests\Staff\UserWarnedRequest;
use App\Models\Allow;
use App\Models\Group;
use App\Models\Log;
use App\Models\Moderate;
use App\Models\Note;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private $pendent, $activated, $suspended, $banned, $log;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->middleware('allow:usuarios-mod');
        $this->pendent = $user;
        $this->activated = $user;
        $this->suspended = $user;
        $this->banned = $user;
        $this->log = new Log();
    }

    public function index()
    {
        $pendent = $this->pendent->where('status', '=', 0)->count();
        $activated = $this->activated->where('status', '=', 1)->count();
        $suspended = $this->suspended->where('status', '=', 2)->count();
        $banned = $this->banned->where('status', '=', 3)->count();

        $users = User::select('id', 'group_id', 'username', 'status', 'avatar')->orderBy('username', 'ASC')->get();
        $groups = Group::select('id', 'name')->get();

        return view('staff.users.index', compact('users', 'groups', 'pendent', 'activated', 'suspended', 'banned'));
    }

    public function edit($user_id)
    {
        $user = User::where('id', '=', $user_id)->first();
        abort_unless($user->id !== auth()->user()->id, 403);
        $groups = Group::all()->pluck('name', 'id');
        return view('staff.users.edit', compact('user', 'groups'));
    }

    public function update(UserUpdatesRequest $request, $user_id)
    {
        $user = User::find($user_id);
        $user->update($request->except('_token'));
        abort_unless($user->id !== auth()->user()->id, 403);
        $group = $request->input('group_id');
        if ($user->group_id !== $group) {
            $user->group_id = $group;
            $user->save();
            $this->log::record('Staff atualizou classe do membro', true);
        }

        $this->log::record('Staff atualizou conta do membro', true);

        toastr()->info('Usuário atualizado.', 'Sucesso');
        return redirect()->to('staff/users');
    }

    public function formBan($user_id)
    {
        $user = DB::table('users')->select('id', 'username')->where('id', '=', $user_id)->first();
        return view('staff.users.banning', compact('user'));
    }

    public function postBan(UserBannedRequest $request)
    {
        $modUser = new Moderate();
        $user_id = $request->input('user_id');
        $modUser->user_id = $user_id;
        $modUser->staff_id = $request->user()->id;
        $modUser->title = $request->input('title');
        $modUser->description = $request->input('description');
        $modUser->is_banned = true;
        $modUser->save();

        DB::table('users')->where('id', '=', $user_id)->update(['status' => 3, 'disabled_at' => now()]);

        $this->log::record('Staff baniu um membro', true);

        toastr()->warning('Usuário Banido.', 'Aviso');
        return redirect()->to('staff/users');
    }

    public function formSuspend($user_id)
    {
        $user = DB::table('users')->select('id', 'username')->where('id', '=', $user_id)->first();
        return view('staff.users.suspending', compact('user'));
    }

    public function postSuspend(UserSuspendedRequest $request)
    {
        $modUser = new Moderate();
        $user_id = $request->input('user_id');
        $modUser->user_id = $user_id;
        $modUser->staff_id = $request->user()->id;
        $modUser->title = $request->input('title');
        $modUser->description = $request->input('description');
        $modUser->is_suspended = true;
        $modUser->expires_on = Carbon::now()->addDays($request->input('days'));
        $modUser->save();

        DB::table('users')->where('id', '=', $user_id)->update(['status' => 2]);

        $this->log::record('Staff suspendeu conta de membro', true);

        toastr()->info('Usuário Suspenso.', 'Aviso');
        return redirect()->to('staff/users');
    }

    public function formWarn($user_id)
    {
        $user = DB::table('users')->select('id', 'username')->where('id', '=', $user_id)->first();
        return view('staff.users.warning', compact('user'));
    }

    public function postWarn(UserWarnedRequest $request)
    {
        $modUser = new Moderate();
        $user_id = $request->input('user_id');
        $modUser->user_id = $user_id;
        $modUser->staff_id = $request->user()->id;
        $modUser->title = $request->input('title');
        $modUser->description = $request->input('description');
        $modUser->is_warned = true;
        $modUser->expires_on = Carbon::now()->addDays($request->input('days'));
        $modUser->save();

        DB::table('users')->where('id', '=', $user_id)->update(['is_warned' => true]);

        $this->log::record('Staff advertiu membro', true);

        toastr()->info('Usuário Advertido.', 'Aviso');
        return redirect()->to('staff/users');
    }

    public function formNote($user_id)
    {
        $user = User::select('id', 'username')->where('id', '=', $user_id)->first();
        $notes = Note::where('user_id', '=', $user_id)->orderBy('id', 'DESC')->get();
        return view('staff.users.notes', compact('user', 'notes'));
    }

    public function postNote(UserNotesRequest $request)
    {
        $note = new Note();
        $user_id = $request->input('user_id');
        $note->user_id = $user_id;
        $note->staff_id = $request->user()->id;
        $note->description = $request->input('description');
        $note->save();

        toastr()->info('Anotação adicionada ao usuário.', 'Sucesso');
        return redirect()->route('staff.user.notes', ['id' => $user_id]);
    }

    public function search(Request $request)
    {
        if ($request->isMethod('POST')) {

            $pendent = $this->pendent->where('status', '=', 0)->count();
            $activated = $this->activated->where('status', '=', 1)->count();
            $suspended = $this->suspended->where('status', '=', 2)->count();
            $banned = $this->banned->where('status', '=', 3)->count();

            $groups = Group::select('id', 'name')->get();

            $group = $request->input('group');
            $status = $request->input('status');

            if ($request->has('group') && !empty($group) && $group != null && $group != '') {
                $users = User::with('group:id,name')
                    ->select('id', 'group_id', 'username', 'avatar', 'status')
                    ->where('group_id', '=', $group)
                    ->get(); // Returns only users with the group
            }
            if ($request->has('status') && !empty($status) && $status != null && $status != '') {
                $users = User::with('group:id,name')
                    ->select('id', 'group_id', 'username', 'avatar', 'status')
                    ->where('status', '=', $status)
                    ->get(); // Returns only users with the status
            }
            if (empty($group) && empty($status)) {
                $users = User::select('id', 'group_id', 'username', 'avatar', 'status')->orderBy('username', 'ASC')->get();
            }
            return view('staff.users.index', compact('users', 'groups', 'pendent', 'activated', 'suspended', 'banned'));
        } else {
            return redirect()->to('staff/users');
        }
    }

    public function formPermission(int $user_id)
    {
        $user = User::where('id', '=', $user_id)->select('id', 'username')->first();
        abort_unless($user->id !== auth()->user()->id, 403);
        $permissions = Allow::all()->pluck('name', 'id');

        $allowed = DB::table('user_allows')
            ->where('user_id', '=', $user_id)
            ->pluck('allow_id', 'allow_id')->all();

        return view('staff.users.permissions', compact('user', 'permissions', 'allowed'));
    }

    public function updatePermission(Request $request, int $user_id)
    {
        $user = User::where('id', '=', $user_id)->first();
        abort_unless($user->id !== auth()->user()->id, 403);
        $user->allows()->sync($request->input('allow_id'));

        return redirect()->route('staff.user.permissions', [$user_id]);
    }

    public function avatarDelete($user_id)
    {
        DB::table('users')->where('id', '=', $user_id)->update(['avatar' => null]);
        return redirect()->back();
    }

    public function coverDelete($user_id)
    {
        DB::table('users')->where('id', '=', $user_id)->update(['cover' => null]);
        return redirect()->back();
    }
}
