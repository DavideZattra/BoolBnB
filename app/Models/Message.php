<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'body', 'apartment_id'];

    public function SponsorApartments(){
        return $this->belongsTo('App\Models\Apartment');
    }
}
