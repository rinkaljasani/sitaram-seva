<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventGallery extends Model
{
    use HasFactory;
    protected $fillable = ['custom_id', 'image','is_active','type','event_id'];
    public function getRouteKeyName(){ return 'custom_id'; }
    public function getCreatedAtAttribute($value){   return (new Carbon($value))->format('Y-m-d H:i:s A');}
}
