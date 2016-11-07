<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyController extends Controller
{
    public function edit()
    {
        return view('admin.my.show');
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name'      =>  'required|alpha_dash',
            'password'  =>  'alpha_dash|min:8'
        ]);

        if ($request->input('password')) {
            $user->update('password', bcrypt($request->input('password')));
        }

        $request->user()->update([
            'name'  =>  $request->input('name')
        ]);
        
        return redirect('admin');
    }
}