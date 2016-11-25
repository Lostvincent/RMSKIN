<?php

namespace App\Http\Controllers\Admin;

use Storage;
use Carbon;
use ImageTool;
use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkinController extends Controller
{
    protected $disk;
    public function __construct(Request $request)
    {
        $this->disk = Storage::disk('skin');
    }

    public function index(Request $request)
    {
        $skins = new Skin;
        if (!$request->user()->isRole('admin|helper')) {
            $skins = $skins->where('user_id', $request->user()->id);
        }
        $skins = $skins->orderBy('id', 'DESC')->paginate(10);

        return view('admin.skin.index', ['skins' => $skins]);
    }

    public function show(Request $request, $skin_id)
    {
        $skin = Skin::where('id', $skin_id);
        if (!$request->user()->isRole('admin|helper')) {
            $skin = $skin->where('user_id', $request->user()->id);
        }
        $skin = $skin->firstOrFail();

        return view('admin.skin.show', ['skin' => $skin]);
    }

    public function edit(Request $request, $skin_id)
    {
        $skin = Skin::where('id', $skin_id);
        if (!$request->user()->isRole('admin|helper')) {
            $skin = $skin->where('user_id', $request->user()->id);
        }
        $skin = $skin->firstOrFail();

        return view('admin.skin.show', ['skin' => $skin]);
    }

    public function create()
    {
        return view('admin.skin.show');
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'name'          =>  'required|alpha_dash',
    //         'description'   =>  'string',
    //         'cover'         =>  'image',
    //         'version'       =>  'string',
    //         'is_available'  =>  'boolean',
    //         'is_public'     =>  'boolean',
    //         'skin'          =>  'required|file|mimes:rar,7z,zip,rmskin'
    //     ]);

    //     $token = '';
    //     if (!$request->has('is_public')) {
    //         $token = str_random(100);
    //     }

    //     $file = $request->file('skin');

    //     if ($file->isValid()) {
    //         $skin = Skin::create([
    //             'name'          =>  $request->input('name'),
    //             'description'   =>  $request->input('description'),
    //             'user_id'       =>  $request->user()->id,
    //             'version'       =>  $request->has('version') ? $request->input('version') : Carbon::now()->format('YmdHis'),
    //             'is_available'  =>  $request->input('is_available', 0),
    //             'code'          =>  $token,
    //             'mime'          =>  $file->getClientOriginalExtension()
    //         ]);

    //         if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
    //             $cover = ImageTool::make($request->file('cover'));
    //             $cover->resize(100, 100)->save(public_path('covers/'.$skin->id.'.jpg'));
    //         }

    //         $file->move(storage_path('app/public/skins'), $skin->id.'.'.$file->getClientOriginalExtension());
    //     }

    //     return redirect('admin/skin');
    // }

    public function update(Request $request, $skin_id)
    {
        $this->validate($request, [
            'name'          =>  'required|string',
            'version'       =>  'string',
            'description'   =>  'string',
            'is_available'  =>  'boolean',
            'is_public'     =>  'boolean'
        ]);

        $skin = Skin::findOrFail($skin_id);

        $token = $skin->code;
        if (empty($token) && !$request->has('is_public')) {
            $token = str_random(100);
        } elseif ($request->has('is_public')) {
            $token = '';
        }

        if ($skin->user_id == $request->user()->id || $request->user()->isRole('admin|helper')) {
            if ($request->hasFile('cover') && $request->file('cover')->isValid()) {
                $cover = ImageTool::make($request->file('cover'));
                $cover->resize(100, 100)->save(public_path('covers/'.$skin->id.'.jpg'));
            }

            $skin->update([
                'name'          =>  $request->input('name'),
                'version'       =>  $request->input('version'),
                'description'   =>  $request->input('description'),
                'is_available'  =>  $request->input('is_available', 0),
                'code'          =>  $token
            ]);
        }

        return redirect('admin/skin');
    }

    // public function destory(Request $request, $skin_id)
    // {
    //     $skin = Skin::findOrFail($skin_id);
    //     if ($skin->user_id == $request->user()->id) {
    //         unlink(storage_path('app/public/skins'), $skin->id.'.'.$file->extension());
    //         $skin->delete();
    //     }

    //     return redirect('admin/skin');
    // }


    public function token(Request $request)
    {
        $up_token = $this->disk->getDriver()->uploadToken(null, 1800, [
                'callbackUrl'  => 'http://rmskin.net/upload/callback',
                'callbackBody' => 'key=$(key)&hash=$(etag)&name=$(fname)&mimeType=$(mimeType)&user_id='.$request->user()->id,
                'saveKey'      => 'skin/$(year)$(mon)$(day)$(hour)$(min)$(sec)_$(etag)$(ext)',
                'fsizeLimit'   => 31457280,
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
                'code'          =>  str_random(100)
            ]);
            return response()->json(['code' => 200, 'key' => $request->key, 'hash' => $request->hash, 'skin_id' => $skin->id]);
        }
        return abort(404);
    }
}
