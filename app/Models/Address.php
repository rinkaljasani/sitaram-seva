<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = ['custom_id','city_id','title','address','manager_name','contact_no','alternative_contact_no','image'];
    public function getRouteKeyName(){ return 'custom_id'; }
    public function city(){ return $this->belongsTo(City::class); }
}
