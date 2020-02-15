<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Allow;
use App\Models\UserAllow;
use Illuminate\Http\Request;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:acesso-total');
    }

    public function index()
    {
        $usual_perms = Allow::where('is_staff', '=', false)->get();

        $staff_perms = Allow::where('is_staff', '=', true)->get();

        return view('staff.permissions.index', compact('usual_perms', 'staff_perms'));
    }

    public function users($permission_id)
    {
        $permission = Allow::find($permission_id);

        $users = UserAllow::with('user:id,group_id,username,status,avatar')
            ->where('allow_id', '=', $permission_id)
            ->get();

        return view('staff.permissions.permission', compact('permission', 'users'));
    }

}
