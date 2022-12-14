<?php

namespace App\Models;

use App\Notifications\AdminResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['full_name', 'email', 'password', 'contact_no', 'permissions', 'is_active', 'type', 'profile'];
    protected $hidden = ['password', 'remember_token',];
    public function sendPasswordResetNotification($token){ $this->notify(new AdminResetPassword($token)); }
}
