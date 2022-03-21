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
class LeadsController extends Controller{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }    


    public function index(){
        
        $template = ['title' => 'Leads',"subtitle"=>"Our Leads",
                     'scripts'=>[asset('admin/js/page/sales-leads.js')]];
        if(true){                
           return View::make('admin.sales.leads')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
    public function getLeadsenQdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $query = DB::table("app_enQ");
        
        $query->select('*');
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table("app_enQ")->count();
        $result=[];$i=1;
         foreach($users as $each){
                 $eachData=array();
                 $cat =  DB::table('categories')->where('slug',$each->enQFor)->first();
                 $eachData['img']        = '<img src="'.asset('site_assets/categories/'.$cat->mobile_icon).'" class="wd-36 rounded-circle" alt="Image">';
                 $eachData['title']        = ucwords(strtolower(str_replace('-',' ',$each->enQFor)));
                 $eachData['mobile']       = '<a href="#" class="tx-inverse tx-14 tx-medium d-block">'.$each->mobile.'</a>';
                    //   <span class="tx-11 d-block">TRANSID: 1234567890</span>';
                  $eachData['type']      = ucwords(strtolower(str_replace('-',' ',$each->enQFor)));
                  $eachData['date']       = date("jS M Y", strtotime($each->created_at));
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
    
    public function getLeadsQuotedatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        $query = DB::table("app_quote");
        
        $query->select('*')->where('status','!=','SOLD');
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table("app_quote")->where('status','!=','SOLD')->count();
        $result=[];$i=1;
         foreach($users as $each){
                 
                 $suppName = DB::table("our_partners")->where('shortName','=',$each->provider)->value('name');
                 $eachData=array();
                 $eachData['customer']       = '<a href="#" class="tx-inverse tx-14 tx-medium d-block">'.$each->customer_mobile.'</a>
                                                <span class="tx-11 d-block">'.$each->customer_name.' </span>';
                $eachData['type']    =            '<a href="#" class="tx-inverse tx-12 d-block">'.ucfirst(strtolower($each->type)).'-Insurance</a>
                                                <span class="tx-11 d-block">'.$each->policyType.'</span>';
                $eachData['partner']   = $suppName;
                $eachData['action']     = $each->status;
                $eachData['date']       = date("jS M Y", strtotime($each->created_at));
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
   
   
   function getLeadsDetails(Request $request){
       $lead =  DB::table("leads")->where('id','=',$request->lead_id)->first();
       $data['lead']= $lead;
       if($lead->type=='HEALTH'){
          return View::make('admin.sales.viewLeadDetails_health')->with($data);  
       }else{
           print_r($lead);
           echo "Something went wrong try again";
       }
   }
   
}
 