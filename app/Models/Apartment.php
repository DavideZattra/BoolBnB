<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = ['descriptive_title', 'rooms', 'beds', 'bathrooms', 'square_meters', 'image', 'description', 'visibility'];

    public function address() {
        return $this->hasOne('App\Models\Address');
    }
    
        public function messages(){
        return $this->hasMany('App\Models\Message');
    }
}
