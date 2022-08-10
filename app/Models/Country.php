<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['custom_id', 'code', 'name', 'phonecode','is_active'];
    public function getRouteKeyName(){ return 'custom_id'; }
    public function getName(){ return $this->name; }
    public function getCode(){ return $this->code; }
    public function getPhoneCode(){ return $this->phonecode; }

    public function cities(){ return $this->hasMany('App\Models\City'); }
    public function states(){ return $this->hasMany('App\Models\State'); }

    public   function getNameAttribute($value){return ucfirst($value);}
}
