<?php
    namespace App;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;

    class Customers extends Authenticatable
    {
        use Notifiable;

        protected $guard = 'customers';

        protected $fillable = [
            'mobile','last_otp',
        ];

        protected $hidden = [
            'last_otp', 'remember_token',
        ];
    }