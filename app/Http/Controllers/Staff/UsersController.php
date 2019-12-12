<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\UserBannedRequest;
use App\Http\Requests\Staff\UserNotesRequest;
use App\Http\Requests\Staff\UserSuspendedRequest;
use App\Http\Requests\Staff\UserUpdatesRequest;
use App\Http\Requests\Staff\UserWarnedRequest;
use App\Models\Group;
use App\Models\Moderate;
use App\Models\Note;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private $pendent, $activated, $suspended, $banned;

    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->pendent = $user->where('status', '=', 0)->count();
        $this->activated =  $user->where('status', '=', 1)->count();
        $this->suspended =  $user->where('status', '=', 2)->count();
        $this->banned =  $user->where('status', '=', 3)->count();
    }

    public function index()
    {
        $pendent = $this->pendent;
        $activated = $this->activated;
        $suspended = $this->suspended;
        $banned = $this->banned;

        $users = User::with('group:id,name')->select('id', 'group_id', 'username', 'status', 'avatar')->orderBy('username', 'ASC')->get();
        $groups = Group::select('id', 'name')->get();
        return view('staff.users.index', compact('users', 'groups', 'pendent', 'activated', 'suspended', 'banned'));
    }

    public function edit($user_id)
    {
        $user = User::where('id', '=', $user_id)->first();
        $groups = Group::all()->pluck('name', 'id');
        return view('staff.users.edit', compact('user', 'groups'));
    }

    public function update(UserUpdatesRequest $request, $user_id)
    {
        $user = User::find($user_id);
        $user->update($request->except('_token'));

        $group = $request->input('group');
        if ($user->group_id !== $group) {
            $user->group_id = $group;
            $user->save();
            //$this->log::novo('Staff atualizou classe do membro', true);
        }

        //$this->log::novo('Staff atualizou conta do membro', true);

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

        DB::table('users')->where('id', '=', $user_id)->update(['status' => 3]);

        //$this->log::novo('Staff baniu um membro', true);

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

        //$this->log::novo('Staff suspendeu conta de membro', true);

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

        //$this->log::novo('Staff advertiu membro', true);

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

            $pendent = $this->pendent;
            $activated = $this->activated;
            $suspended = $this->suspended;
            $banned = $this->banned;

            $groups = Group::select('id', 'name')->get();

            $group = $request->get('group');
            $status = $request->get('status');

            if ($request->has('group') && !empty($group) && $group != null && $group != '') {
                $users = User::with('group:id,name')
                    ->select('id', 'group_id', 'username', 'avatar', 'status')
                    ->where('group_id', '=', $group)
                    ->get(); // Returns only users with the group
            }
            if ($request->has('status') && !empty($status) && $status != null && $status != '') {
                $users = User::where('status', '==', $status)->select('id', 'group_id', 'username', 'avatar', 'status')->get();
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
        $user = User::where('id', '=', $user_id)->first();
        $permission = Permission::where('user_id', '=', $user->id)->first();

        return view('staff.users.permissions', compact('user','permission'));
    }

    public function updatePermission(Request $request, int $user_id)
    {
        $permission = Permission::where('user_id', '=', $user_id)->first();
        $permission->actors_comment = $request->input('actors_comment') ? true : false;
        $permission->calendars_create = $request->input('calendars_create') ? true : false;
        $permission->calendars_comment = $request->input('calendars_comment') ? true : false;
        $permission->characters_comment = $request->input('characters_comment') ? true : false;
        $permission->chatbox_view = $request->input('chatbox_view') ? true : false;
        $permission->fansubs_comment = $request->input('fansubs_comment') ? true : false;
        $permission->medias_comment = $request->input('medias_comment') ? true : false;
        $permission->studios_comment = $request->input('studios_comment') ? true : false;
        $permission->torrents_comment = $request->input('torrents_comment') ? true : false;
        $permission->torrents_upload = $request->input('torrents_upload') ? true : false;
        $permission->torrents_download = $request->input('torrents_download') ? true : false;
        $permission->staff_panel = $request->input('staff_panel') ? true : false;
        $permission->full_access = $request->input('full_access') ? true : false;
        $permission->achievements_mod = $request->input('achievements_mod') ? true : false;
        $permission->actors_mod = $request->input('actors_mod') ? true : false;
        $permission->backups_mod = $request->input('backups_mod') ? true : false;
        $permission->bonus_mod = $request->input('bonus_mod') ? true : false;
        $permission->calendars_mod = $request->input('calendars_mod') ? true : false;
        $permission->categories_mod = $request->input('categories_mod') ? true : false;
        $permission->characters_mod = $request->input('characters_mod') ? true : false;
        $permission->cheaters_mod = $request->input('cheaters_mod') ? true : false;
        $permission->commands_mod = $request->input('commands_mod') ? true : false;
        $permission->failed_logins_mod = $request->input('failed_logins_mod') ? true : false;
        $permission->fansubs_mod = $request->input('fansubs_mod') ? true : false;
        $permission->faqs_mod = $request->input('faqs_mod') ? true : false;
        $permission->forums_mod = $request->input('forums_mod') ? true : false;
        $permission->genres_mod = $request->input('genres_mod') ? true : false;
        $permission->logs_mod = $request->input('logs_mod') ? true : false;
        $permission->lotteries_mod = $request->input('lotteries_mod') ? true : false;
        $permission->medias_mod = $request->input('medias_mod') ? true : false;
        $permission->moods_mod = $request->input('moods_mod') ? true : false;
        $permission->news_mod = $request->input('news_mod') ? true : false;
        $permission->permissions_mod = $request->input('permissions_mod') ? true : false;
        $permission->polls_mod = $request->input('polls_mod') ? true : false;
        $permission->reports_mod = $request->input('reports_mod') ? true : false;
        $permission->requests_mod = $request->input('requests_mod') ? true : false;
        $permission->groups_mod = $request->input('groups_mod') ? true : false;
        $permission->rules_mod = $request->input('rules_mod') ? true : false;
        $permission->settings_mod = $request->input('settings_mod') ? true : false;
        $permission->studios_mod = $request->input('studios_mod') ? true : false;
        $permission->torrents_mod = $request->input('torrents_mod') ? true : false;
        $permission->users_mod = $request->input('users_mod') ? true : false;
        $permission->visitors_mod = $request->input('visitors_mod') ? true : false;
        $permission->save();

        return redirect()->route('staff.user.permissions', [$user_id]);
    }
}
