<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::paginate(20);

        return view('admin.user.index', ['users' => $users]);
    }

    public function show($user_id)
    {
        return $this->edit($user_id);
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $roles = Role::all();
     
        return view('admin.user.show', ['user' => $user, 'roles' => $roles]);
    }

    public function create(Request $request)
    {
        $roles = Role::all();

        return view('admin.user.show', ['roles' => $roles]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|alpha_dash',
            'password'  =>  'required|min:8',
            'email'     =>  'required|email|unique:users,email',
            'slug'      =>  'required|exists:roles,id'
        ]);

        $user = User::create([
            'email'     =>  $request->input('email'),
            'password'  =>  bcrypt($request->input('password')),
            'name'      =>  $request->input('name')
        ]);
        $user->attachRole($request->input('slug'));
        $user->save();

        return redirect('admin/user');
    }

    public function update(Request $request, $user_id = 0)
    {
        $this->validate($request, [
            'name'      =>  'required|alpha_dash',
            'email'     =>  "required|email|unique:users,email,$user_id",
            'slug'      =>  'required|exists:roles,id'
        ]);

        $user = User::findOrFail($user_id);
        if ($request->input('password')) {
            $user->update('password', bcrypt($request->input('password')));
        }

        $user->detachAllRoles();
        $user->attachRole($request->input('slug'));
        $user->update([
            'email'     =>  $request->input('email'),
            'name'      =>  $request->input('name'),
            'mobile'    =>  $request->input('mobile'),
            'signature' =>  $request->input('signature'),
            'privacy'   =>  $request->input('privacy'),
            'zones'     =>  $request->input('zones'),
            'tfa_token' =>  $request->input('tfa_token')
        ]);

        return redirect('admin/user');
    }

    public function destroy(Request $request, $user_id = 0)
    {
        $user = User::findOrFail($user_id);
        $user->detachAllRoles();
        $user->delete();

        return redirect('admin/user');
    }
}