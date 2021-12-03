<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function apartment() {
        return $this->hasOne('App\Models\Apartment');
    }
}
