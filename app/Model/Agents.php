<?php

namespace App\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agents extends Authenticatable
{
     use Notifiable;

       protected $hidden = [
        'password', 'remember_token',
    ];
  
}
