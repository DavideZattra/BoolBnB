<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = ['name', 'duration', 'price'];

    public function apartment(){
        return $this->belongsToMany('App\Models\Apartment');
    }
}
