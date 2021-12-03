<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    protected $fillable = ['name'];

    public function apartment(){
        return $this->belongsTo('App\Models\Apartment');
    }
}
