<?php

namespace App\Http\Controllers\Admin;

use Log;
use Carbon;
use Storage;
use App\Models\Skin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }
}
