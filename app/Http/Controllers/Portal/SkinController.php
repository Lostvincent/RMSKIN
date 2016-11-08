<?php

namespace App\Http\Controllers\Portal;

use Cache;
use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkinController extends Controller
{
    public function show($skin_id)
    {
        $skin = Skin::findOrFail($skin_id);
        $skin->increment('views');

        return view('portal.skin.show', ['skin' => $skin]);
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

        return response()->download(storage_path('app/public/skins/'.$skin->id.'.'.$skin->mime));
    }
}
