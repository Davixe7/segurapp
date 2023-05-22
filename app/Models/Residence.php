<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residence extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden  = ['created_at', 'updated_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function porterias(){
        return $this->hasMany(User::class, 'residence_id', 'id');
    }

    public function reports(){
        return $this->hasMany(Report::class);
    }

    public function apartments(){
        return $this->hasMany(Apartment::class);
    }

    public function complaints(){
        return $this->hasMany(Complaint::class);
    }

    public function visits(){
        return $this->hasMany(Visit::class);
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }
}
