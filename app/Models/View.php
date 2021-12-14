<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = ['visited_at', 'ip_address', 'apartment_id'];

    public function apartment(){
        return $this->belongsTo('App\Models\Apartment');
    }
}
