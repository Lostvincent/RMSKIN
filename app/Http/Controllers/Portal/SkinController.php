<?php

namespace App\Http\Controllers\Portal;

use Cache;
use Storage;
use App\Models\User;
use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkinController extends Controller
{
    public function index(Request $request)
    {
        $skins = Skin::orderBy('id', 'DESC')->paginate(10);

        return view('portal.skin.index', ['skins' => $skins]);
    }

    public function show($skin_id)
    {
        $skin = Skin::findOrFail($skin_id);
        $user = User::find($skin->user_id);

        $skin->increment('views');
        return view('portal.skin.show', ['skin' => $skin, 'user' => $user]);
    }

    public function download(Request $request, $skin_id)
    {
        $times = Cache::get('ip_'.$request->ip(), 0);
        if ($times > 15) {
            abort(403);
        }

        $skin = Skin::find($skin_id);
        if (empty($skin) || !$skin->is_available) {
            return redirect()->back()->withErrors('皮肤不存在或禁止下载。');
        }

        if (!empty($skin->code)) {
            $this->validate($request, [
                'code'  =>  'required|string|size:100'
            ]);

            if ($request->input('code') != $skin->code) {
                return redirect()->back()->withErrors('皮肤下载码错误。');
            }
        }
        
        Cache::put('ip_'.$request->ip(), $times + 1, 15);
        $skin->increment('downloads');
        
        $disk = Storage::disk('skin');
        return redirect($disk->getDriver()->privateDownloadUrl($skin->path, ['domain' => 'https', 'expires' => 3600])->getUrl());
    }
}
