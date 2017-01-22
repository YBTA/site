<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kodeine\Metable\Metable;

class House extends Model
{
  use Metable;
  protected $metaTable = 'house__metas';
  protected $fillable = [
    'number',
   'address',
   'postcode',
   'lat',
   'lng',
   'address_first_line',
   'address_second_line',
   'address_third_line',
   'address_forth_line',
   'address_locality',
   'address_town',
   'address_county'
 ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
