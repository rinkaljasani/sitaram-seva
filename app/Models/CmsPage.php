<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsPage extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'file', 'edited_by','custom_id',
    ];
    public function getRouteKeyName(){ return 'custom_id'; }
    public function getDescriptionAttribute($description){
        return strip_tags(html_entity_decode($description));
    }
}
