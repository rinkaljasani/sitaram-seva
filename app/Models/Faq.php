<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    protected $fillable = [
        'custom_id', 'question', 'answer',
    ];

    public function getRouteKeyName(){ return 'custom_id'; }
    public function getQuestion(){ return $this->question; }
    public function getAnswer(){ return $this->answer; }
}
