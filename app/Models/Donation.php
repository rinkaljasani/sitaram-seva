<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    protected $fillable = ['custom_id', 'donar_name','donar_email','donar_image','amount','message','category_id','status','is_active'];
    public function getRouteKeyName(){ return 'custom_id'; }

    public function getCreatedAtAttribute($value){   return (new Carbon($value))->format('Y-m-d A');}
    public function category(){   return $this->belongsTo(Category::class); }
    public   function getDonarNameAttribute($value){return ucfirst($value); }
}
