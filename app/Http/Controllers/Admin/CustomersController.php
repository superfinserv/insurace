<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;
//use App\Utils\AppUtil;
class CustomersController extends Controller{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }    


    public function index(){
        
        $template = ['title' => 'Customers',"subtitle"=>"Customers List",
                     'scripts'=>[asset('admin/js/page/customers.js')]];
        if(true){                
           return View::make('admin.customers.customers')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
     public function getCustomersdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $query = DB::table("customers");
        
        $query->select('*');
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table("customers")->count();
        $result=[];$i=1;
         foreach($users as $each){
                 $eachData=array();
                 $eachData['sno']        = "<strong>".$i."</strong>";
                 $eachData['name']       = ($each->name)?$each->name:"<span class='text-danger'>Not available</span>";
                 $eachData['mobile']     = "+91 ".$each->mobile;
                 $eachData['email']      = ($each->email)?$each->email:"<span class='text-danger'>Not available</span>";
                 $eachData['created_at'] = $each->created_at;
                 $eachData['status']     = ($each->status==1)?"<span class='text-success'>verified</span>":"<span class='text-danger'>unverified</span>";
                 $eachData['action']     = "-";
               
                $result[] = $eachData; 
              
             $i++; 
         }
         $json_data = array(
           "draw"            => intval($request->input('draw')),  
           "recordsTotal"    => intval($totalRecords),  
           "recordsFiltered" => intval($totalFiltered),  
           "data"            => $result   
           );
        echo json_encode($json_data); 
   }
   
}
 

