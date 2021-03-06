<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'descriptive_title', 'rooms', 'beds', 'bathrooms', 'square_meters', 'image', 'description', 'visibility'];

    public function addresses() {
        return $this->hasOne('App\Models\Address');
    }
    
        public function messages(){
        return $this->hasMany('App\Models\Message');
    }

    public function users(){
        return $this->hasOne('App\Models\Users');
    }

    public function views(){
        return $this->hasMany('App\Models\view');
    }

    public function sponsor(){
        return $this->hasMany('App\Models\SponsorApartment', 'apartment_id');
    }

    public function amenities(){
        return $this->belongsToMany('App\Models\Amenity');
    }
}
