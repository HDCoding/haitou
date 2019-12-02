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
//        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('position', 'ASC')->where('is_forum', '=', true)->get();
        $forums = Forum::orderBy('position', 'ASC')->get();
        $moderators = Moderator::all();
        return view('staff.forums.index', compact('categories', 'forums', 'moderators'));
    }

    public function create()
    {
        if (Category::where('is_forum', '=', true)->count() <= 0) {
            toastr()->error('Nenhuma categoria cadastrada, registre uma para continuar', 'Erro');
            return redirect()->to('staff/forums');
        } else {
            $categories = Category::all()->where('is_forum', '=', true)->pluck('name', 'id');
            $roles = Group::select('id', 'name')->get();
            return view('staff.forums.create', compact('categories', 'roles'));
        }
    }

    public function store(ForumsRequest $request)
    {
        $roles = Group::all();

        $forum = new Forum($request->except('_token'));
        $forum->save();

        //Permissions
        foreach ($roles as $key => $role) {
            $perm = Permission::whereRaw('forum_id = ? AND role_id = ?', [$forum->id, $role->id])->first();
            if (!$perm) {
                $perm = new Permission();
            }
            $perm->forum_id = $forum->id;
            $perm->role_id = $role->id;

            if (array_key_exists($role->id, $request->input('permissions'))) {
                $perm->view_forum = (isset($request->input('permissions')[$role->id]['view_forum'])) ? true : false;
                $perm->read_topic = (isset($request->input('permissions')[$role->id]['read_topic'])) ? true : false;
                $perm->reply_topic = (isset($request->input('permissions')[$role->id]['reply_topic'])) ? true : false;
                $perm->start_topic = (isset($request->input('permissions')[$role->id]['start_topic'])) ? true : false;
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
        $roles = Group::select('id', 'name')->get();
        return view('staff.forums.edit', compact('forum', 'categories', 'roles'));
    }

    public function update(ForumsRequest $request, $forum_id)
    {
        $roles = Group::all();

        $forum = Forum::findOrFail($forum_id);
        $forum->update($request->except('_token'));

        // Permissions
        foreach ($roles as $key => $role) {
            $perm = ForumPermission::whereRaw('forum_id = ? AND role_id = ?', [$forum->id, $role->id])->first();
            if ($perm == null) {
                $perm = new Permission();
            }
            $perm->forum_id = $forum->id;
            $perm->role_id = $role->id;

            if (array_key_exists($role->id, $request->input('permissions'))) {
                $perm->view_forum = (isset($request->input('permissions')[$role->id]['view_forum'])) ? true : false;
                $perm->read_topic = (isset($request->input('permissions')[$role->id]['read_topic'])) ? true : false;
                $perm->reply_topic = (isset($request->input('permissions')[$role->id]['reply_topic'])) ? true : false;
                $perm->start_topic = (isset($request->input('permissions')[$role->id]['start_topic'])) ? true : false;
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

    public function formAddMod($forum_id)
    {
        $forum = Forum::find($forum_id);
        $members = User::where('status', '=', 1)->select('id', 'name')->pluck('name', 'id');
        return view('staff.forums.mod.create', compact('members', 'forum'));
    }

    public function postAddMod(Request $request, $forum_id)
    {
        $forum = Forum::find($forum_id);
        $forum->moderators()->attach($request->input('staff_id'));
        toastr()->info('Moderadores adicionado.', 'Aviso');
        return redirect()->to('staff/forums');
    }

    public function formEditMod($forum_id)
    {
        $forum = Forum::find($forum_id);
        $members = User::where('status', '=', 1)->select('id', 'name')->pluck('name', 'id');
        $mod = Moderator::all()->where('forum_id', '=', $forum->id)->pluck('staff_id');
        return view('staff.forums.mod.edit', compact('members', 'forum', 'mod'));
    }

    public function postEditMod(Request $request, $forum_id)
    {
        $forum = Forum::find($forum_id);
        $forum->moderators()->sync($request->input('staff_id'));
        toastr()->info('Moderadores atualizados.', 'Aviso');
        return redirect()->to('staff/forums');
    }
}
