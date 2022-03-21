<?php
    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Laravel\Passport\HasApiTokens;
    
    class Agents extends Authenticatable
    {
         use HasApiTokens, Notifiable;

        protected $guard = 'agents';

        protected $fillable = [
            'name','email','password','mobile'
        ];

        protected $hidden = [
            'password', 'remember_token',
        ];
    }