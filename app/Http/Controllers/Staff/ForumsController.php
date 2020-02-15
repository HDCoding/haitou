<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\ForumsRequest;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Group;
use App\Models\Moderator;
use App\Models\Permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:forum-mod');
    }

    public function index()
    {
        $categories = Category::orderBy('position', 'ASC')->where('is_forum', '=', true)->get();
        $forums = Forum::with('topics:id,forum_id')->orderBy('position', 'ASC')->get();
        $moderators = Moderator::with('user:id,username')->get();

        return view('staff.forums.index', compact('categories', 'forums', 'moderators'));
    }

    public function create()
    {
        if (Category::where('is_forum', '=', true)->count() <= 0) {
            toastr()->error('Nenhuma categoria cadastrada, registre uma para continuar', 'Erro');
            return redirect()->to('staff/forums');
        } else {
            $categories = Category::all()->where('is_forum', '=', true)->pluck('name', 'id');
            $groups = Group::select('id', 'name')->get();
            return view('staff.forums.create', compact('categories', 'groups'));
        }
    }

    public function store(ForumsRequest $request)
    {
        $groups = Group::all();

        $forum = new Forum($request->except('_token'));
        $forum->save();

        //Permissions
        foreach ($groups as $key => $group) {
            $perm = Permission::whereRaw('forum_id = ? AND group_id = ?', [$forum->id, $group->id])->first();
            if (!$perm) {
                $perm = new Permission();
            }
            $perm->forum_id = $forum->id;
            $perm->group_id = $group->id;

            if (array_key_exists($group->id, $request->input('permissions'))) {
                $perm->view_forum = (isset($request->input('permissions')[$group->id]['view_forum'])) ? true : false;
                $perm->read_topic = (isset($request->input('permissions')[$group->id]['read_topic'])) ? true : false;
                $perm->reply_topic = (isset($request->input('permissions')[$group->id]['reply_topic'])) ? true : false;
                $perm->start_topic = (isset($request->input('permissions')[$group->id]['start_topic'])) ? true : false;
            } else {
                $perm->view_forum = false;
                $perm->read_topic = false;
                $perm->reply_topic = false;
                $perm->start_topic = false;
            }
            $perm->save();
        }

        toastr()->success('Novo forum cadastrado.', 'Sucesso');
        return redirect()->to('staff/forums');
    }

    public function edit($forum_id)
    {
        $forum = Forum::findOrFail($forum_id);
        $categories = Category::all()->where('is_forum', '=', true)->pluck('name', 'id');
        $groups = Group::select('id', 'name')->get();
        return view('staff.forums.edit', compact('forum', 'categories', 'groups'));
    }

    public function update(ForumsRequest $request, $forum_id)
    {
        $groups = Group::all();

        $forum = Forum::findOrFail($forum_id);
        $forum->update($request->except('_token'));

        // Permissions
        foreach ($groups as $key => $group) {
            $perm = Permission::whereRaw('forum_id = ? AND group_id = ?', [$forum->id, $group->id])->first();
            if ($perm == null) {
                $perm = new Permission();
            }
            $perm->forum_id = $forum->id;
            $perm->group_id = $group->id;

            if (array_key_exists($group->id, $request->input('permissions'))) {
                $perm->view_forum = (isset($request->input('permissions')[$group->id]['view_forum'])) ? true : false;
                $perm->read_topic = (isset($request->input('permissions')[$group->id]['read_topic'])) ? true : false;
                $perm->reply_topic = (isset($request->input('permissions')[$group->id]['reply_topic'])) ? true : false;
                $perm->start_topic = (isset($request->input('permissions')[$group->id]['start_topic'])) ? true : false;
            } else {
                $perm->view_forum = false;
                $perm->read_topic = false;
                $perm->reply_topic = false;
                $perm->start_topic = false;
            }
            $perm->save();
        }

        toastr()->info('Forum atualizado.', 'Sucesso');
        return redirect()->to('staff/forums');
    }

    public function destroy($forum_id)
    {
        Forum::findOrFail($forum_id)->delete();
        toastr()->warning('Forum deletado.', 'Aviso');
        return redirect()->to('staff/forums');
    }

    public function order(Request $request)
    {
        if ($request->ajax()) {
            DB::table('forums')
                ->where('id', $request->get('pk'))
                ->update([$request->get('name') => $request->get('value')]);
            return response()->json(['success' => 'Mood atulizado.'], 200);
        }
        return response()->json(['error' => 400, 'message' => 'Parametros insuficientes.'], 400);
    }

    public function formModerators($forum_id)
    {
        $forum = Forum::find($forum_id);
        $members = User::where('status', '=', 2)->select('id', 'username')->pluck('username', 'id');

        $member = DB::table('moderators')
            ->where('forum_id', '=', $forum_id)
            ->pluck('user_id', 'user_id')->all();

        return view('staff.forums.moderators', compact('members', 'forum', 'member'));
    }

    public function postModerators(Request $request, $forum_id)
    {
        $forum = Forum::find($forum_id);
        $forum->moderators()->sync($request->input('user_id'));

        toastr()->info('Moderadores adicionado.', 'Aviso');
        return redirect()->to('staff/forums');
    }

}
