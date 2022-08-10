<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable =  ['custom_id', 'name', 'country_id', 'state_id'];

    public function getRouteKeyName(){ return 'custom_id'; }
    public function getName(){ return $this->name; }
    
    public function country(){ return $this->belongsTo('App\Models\Country'); }
    public function state(){ return $this->belongsTo('App\Models\State'); }
}
