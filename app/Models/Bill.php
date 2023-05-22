<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['updated_at'];
    protected $casts  = [
        'created_at' =>'datetime:Y-m-d H:i:s',
        'updated_at' =>'datetime:Y-m-d H:i:s',
        'starts_at'  =>'datetime:Y-m-d H:i:s',
        'expires_at' =>'datetime:Y-m-d H:i:s',
    ];
}
