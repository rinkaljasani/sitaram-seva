<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gallery extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['custom_id', 'image','type'];
    public function getRouteKeyName(){ return 'custom_id'; }
    public function getCreatedAtAttribute($value)
    {
        return (new Carbon($value))->format('Y-m-d H:i:s A');
    }
    
}
