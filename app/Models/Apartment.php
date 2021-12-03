<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['descriptive_title', 'rooms', 'beds', 'bathrooms', 'square_meters', 'image', 'description', 'visibility'];

    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function user(){
        return $this->hasOne('App\Models\Users');
    }

    public function views(){
        return $this->hasMany('App\Models\view');
    }
}
