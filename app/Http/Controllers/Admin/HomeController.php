<?php

namespace App\Http\Controllers\Admin;

use Carbon;
use Storage;
use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    protected $disk;
    public function __construct(Request $request)
    {
        //parent::__construct($request);
        $this->disk = Storage::disk('skin');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function test(Request $request)
    {
        return view('admin.test');
    }

    public function token(Request $request)
    {
        $up_token = $this->disk->getDriver()->uploadToken(null, 1800, [
                'callbackUrl'  => 'http://rmskin.net/upload/callback',
                'callbackBody' => 'key=$(key)&hash=$(etag)&name=$(fname)&mimeType=$(mimeType)&user_id='.$request->user()->id,
                'saveKey'      => 'skin/$(year)$(mon)$(day)$(hour)$(min)$(sec)_$(etag)$(ext)',
                'fsizeLimit'   => 4194304,
            ], false);
        return response()->json(['code' => 200, 'up_token' => $up_token]);
    }

    public function callback(Request $request)
    {
        if ($this->disk->getDriver()->verifyCallback('application/x-www-form-urlencoded', $request->header('Authorization'), 'http://rmskin.net/upload/callback', $request->getContent())) {
            $skin = Skin::create([
                'user_id'       =>  $request->user_id,
                'path'          =>  $request->key,
                'name'          =>  $request->name,
                'version'       =>  Carbon::now()->format('YmdHis'),
                'is_available'  =>  0,
            ]);
            return response()->json(['code' => 200, 'key' => $request->key, 'hash' => $request->hash, 'skin_id' => $skin->id]);
        }
        return abort(404);
    }
}
