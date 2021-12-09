<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['apartment_id', 'country', 'region', 'province','city', 'address', 'zip_code', 'lat', 'lon'];

    public function apartment() {

        return $this->belongsTo('App\Models\Apartment');
    }
}
