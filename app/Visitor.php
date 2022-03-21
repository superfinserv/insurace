<?php 
 namespace App;
use Illuminate\Database\Eloquent\Model;
class Visitor  extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'app_enQ';
     protected $primaryKey = 'id';
     protected $fillable = ['mobile','customer_id','enquiry_id','enQFor','ip_address'];
     public $timestamps = false;
}
?>