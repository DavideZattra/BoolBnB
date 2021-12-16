<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SponsorApartment extends Model
{
  protected $fillable = [
      'sponsor_id', 'apartment_id','transaction_id', 'start', 'end'];
  
  public $timestamps = false;

  public function apartment()
  {
    return $this->belongsTo('App\Models\Apartment');
  }

  public function sponsor()
  {
    return $this->belongsTo('App\Models\Sponsor');
  }
}
