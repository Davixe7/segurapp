<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at'];

    public function residents(){
        return $this->hasMany(Resident::class);
    }

    public function vehicles(){
        return $this->hasMany(Vehicle::class);
    }
}
