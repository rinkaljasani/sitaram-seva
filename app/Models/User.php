<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $fillable = ['custom_id', 'first_name', 'last_name', 'full_name', 'email', 'country_code', 'contact_no', 'birth_date', 'gender', 'profile_photo', 'password',];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime'];
    protected $appends = ['full_name'];
    public function getRouteKeyName()
    {
        return 'custom_id';
    }
    public function setFullNameAttribute($value)
    {
        return $this->attributes['full_name'] = ucwords($value);
    
    }
    public function balance(){ return $this->hasMany(UserBalance::class);}
}
