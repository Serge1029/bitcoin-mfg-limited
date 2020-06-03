<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

   protected $fillable = ['name', 'photo', 'zip', 'residency', 'city', 'address', 'phone', 'fax', 'email','password','verification_link','affilate_code'];

    protected $hidden = [
        'password', 'remember_token'
    ];

	public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }
    public function withdraws()
    {
        return $this->hasMany('App\Models\Withdraw');
    }
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction','user_id');
    }
}
