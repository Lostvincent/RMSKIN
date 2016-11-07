<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skin extends Model
{
    use SoftDeletes;
    
    protected $table = 'skins';
    protected $guarded = [];
}
