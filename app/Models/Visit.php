<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['updated_at'];
    protected $casts  = ['created_at'=>'datetime:Y-m-d H:i:s'];

    public function apartment(){
        return $this->belongsTo(Apartment::class);
    }
}
