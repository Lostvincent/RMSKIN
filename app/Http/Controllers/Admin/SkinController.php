<?php

namespace App\Http\Controllers\Admin;

use Carbon;
use ImageTool;
use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkinController extends Controller
{
    public function index()
    {
        $skins = Skin::paginate(10);

        return view('admin.skin.index', ['skins' => $skins]);
    }

    public function show($skin_id)
    {
        $skin = Skin::findOrFail($skin_id);

        return view('admin.skin.show', ['skin' => $skin]);
    }

    public function edit($skin_id)
    {
        $skin = Skin::findOrFail($skin_id);

        return view('admin.skin.show', ['skin' => $skin]);
    }

    public function create()
    {
        return view('admin.skin.show');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          =>  'required|alpha_dash',
            'description'   =>  'string',
            // 'cover'         =>  'image',
            'version'       =>  'string',
            'is_available'  =>  'boolean',
            'is_public'     =>  'boolean',
            'skin'          =>  'required|file|mimes:rar,7z,zip,rmskin'
        ]);

        $token = '';
        if ($request->has('is_public')) {
            $token = str_random(100);
        }

        $file = $request->file('skin');
        if ($file->isValid()) {
            //
        }

        $skin = Skin::create([
            'name'          =>  $request->input('name'),
            'description'   =>  $request->input('description'),
            'user_id'       =>  $request->user()->id,
            'version'       =>  $request->input('version', Carbon::now()->format('YmdHis')),
            'is_available'  =>  $request->input('is_available', 0),
            'code'          =>  $token
        ]);

        return redirect('admin/skin');
    }

    public function update(Request $request, $skin_id)
    {
        $this->validate($request, [
            'name'          =>  'required|alpha_dash',
            'description'   =>  'string',
            // 'cover'         =>  'image',
            'is_available'  =>  'boolean',
            'is_public'     =>  'boolean'
        ]);

        $token = '';
        if ($request->has('is_public')) {
            $token = str_random(100);
        }

        $skin = Skin::findOrFail($skin_id);

        if ($skin->user_id == $request->user()->id) {
            $skin->update([
                'name'          =>  $request->input('name'),
                'description'   =>  $request->input('description'),
                'is_available'  =>  $request->input('is_available', 0),
                'code'          =>  $token
            ]);
        }

        return redirect('admin/skin');
    }

    public function destory(Request $request, $skin_id)
    {
        $skin = Skin::findOrFail($skin_id);
        if ($skin->user_id == $request->user()->id) {
            $skin->delete();
        }

        return redirect('admin/skin');
    }
}
