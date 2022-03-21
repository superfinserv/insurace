<?php


namespace App;


//use Illuminate\Notifications\Notifiable;

//use Illuminate\Foundation\Auth\User as Authenticatable;

use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;

class VarientTw  extends Model

{

  //  use Notifiable;

    use SearchableTrait;


     /**

     * Searchable rules.

     *

     * @var array

     */
    protected $table = 'vehicle_variant_tw';
    protected $searchable = [

        'columns' => [

            // 'vehicle_variant_tw.make' => 5,

             'vehicle_variant_tw.modal' =>10,

           //'vehicle_variant_tw.variant' =>10,
             
             'vehicle_variant_tw.vTxt'=>10,
            
            // 'vehicle_variant_tw.cubic_capacity' => 2,
            
            // 'vehicle_variant_tw.fuel_type' => 5,

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