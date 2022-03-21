<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Auth;
//use App\Utils\AppUtil;

class PincodeController extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }

    public function index(Request $request){
        $template = ['title' => 'Pincode',"subtitle"=>"Pincode List"];
      
        $template['scripts'] = [asset('admin/js/page/pincode-master.js')];  
        $template['subtitle'] = "Pincode";
       
        return View::make('admin.pincode.list')->with($template);
    }
    
    public function getPincodedatatable(Request $request){
       //$whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(0 =>'pincode_masters.id',1 =>'pincode_masters.pincode'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $Pincode    = ($request->input('columns.0.search.value'))?:"";
        $District   = ($request->input('columns.1.search.value'))?:"";
        $StateTxt = ($request->input('columns.2.search.value'))?:"";
        $State = ($request->input('columns.3.search.value'))?:"";
        $City = ($request->input('columns.4.search.value'))?:"";
        //$vehicleCC = ($request->input('columns.4.search.value'))?:"";
       // DB::enableQueryLog();
        $query = DB::query();
        $query = DB::table('pincode_masters')
                       ->leftJoin('states', 'states.id', '=', 'pincode_masters.state_id')
                       ->leftJoin('cities', 'cities.id', '=', 'pincode_masters.city_id');
        $query->select('pincode_masters.*','states.name as stateName','cities.name as cityName')
                ->when($Pincode, function ($query, $Pincode) {
                    return $query->where('pincode_masters.pincode','like', '%'.$Pincode.'%') ;
                })
               ->when($StateTxt, function ($query, $StateTxt) {
                    return $query->where('pincode_masters.State','like', '%'.$StateTxt.'%');
                })
                 ->when($District, function ($query, $District) {
                    return $query->where('pincode_masters.District','like', '%'.$District.'%');
                })
               ->when($State, function ($query, $State) {
                    return $query->where('states.id','=', $State);
                })
                 ->when($City, function ($query, $City) {
                   return $query->where('cities.id','=', $State);
                });
                
              
        $totalFiltered =$query->count();
       // $query->orderBy('id','ASC')
        $vehicles =  $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)->get();
           
        $totalRecords =  DB::table('pincode_masters')->count();
        $result=[];$i=($start+1);
         foreach($vehicles as $each){
                
                $eachData=array();
                $eachData['sno']          = $i;
                $eachData['pincode']         = '<a href="#">'.trim($each->pincode).'</a>';
                $eachData['District']        = trim($each->District);
                $eachData['State']           = trim($each->State);    
                $eachData['stateName']    = $each->stateName;
                $eachData['cityName']     = $each->cityName;
               
              
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