<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;
    protected $fillable = ['custom_id', 'name','email','image','contact_no','address','status','is_active','type'];
    public function getRouteKeyName(){ return 'custom_id'; }

    public function getCreatedAtAttribute($value){   return (new Carbon($value))->format('Y-m-d A');}
    public   function getNameAttribute($value){return ucfirst($value); }
}
