<?php


namespace App;


//use Illuminate\Notifications\Notifiable;

//use Illuminate\Foundation\Auth\User as Authenticatable;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class VarientCar  extends Model

{

  //  use Notifiable;

    use SearchableTrait;


     /**

     * Searchable rules.

     *

     * @var array

     */
    protected $table = 'vehicle_variant_car';
    protected $searchable = [

        'columns' => [

            // 'vehicle_variant_car.make' => 5,

             'vehicle_variant_car.modal' =>10,

           //'vehicle_variant_car.variant' =>10,
             
             'vehicle_variant_car.vTxt'=>10,
            
            // 'vehicle_variant_car.cubic_capacity' => 2,
            
            // 'vehicle_variant_car.fuel_type' => 5,

        ]

    ];


    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    // protected $fillable = [

    //     'name', 'email', 'password',

    // ];


    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    // protected $hidden = [

    //     'password', 'remember_token',

    // ];

}