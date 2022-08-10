<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['custom_id', 'image','name','description','is_active'];
    public function getRouteKeyName(){ return 'custom_id'; }
    public function getCreatedAtAttribute($value){   return (new Carbon($value))->format('Y-m-d H:i:s A');  }
    public   function getNameAttribute($value){return ucfirst($value); }

    public function events(){   return $this->hasMany(Event::class); }
}
