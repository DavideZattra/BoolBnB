<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name', 'email', 'body'];


    public function apartment(){
        return $this->belongsTo('App\Models\Apartment');
    }
}
