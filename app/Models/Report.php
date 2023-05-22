<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'created_at'=> 'datetime:Y-m-d H:i:s',
        'read_at'   => 'datetime:Y-m-d H:i:s'
    ];

    public function porteria(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function residence(){
        return $this->belongsTo(Residence::class);
    }
}
