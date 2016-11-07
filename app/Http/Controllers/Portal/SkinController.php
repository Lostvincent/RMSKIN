<?php

namespace App\Http\Controllers\Portal;

use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkinController extends Controller
{
    public function show($skin_id)
    {
        //
        return view('portal.skin.show');
    }

    public function download(Request $request, $skin_id)
    {
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

        return response()->download();
    }
}
