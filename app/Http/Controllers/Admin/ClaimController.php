<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;
class ClaimController extends Controller{
     public function __construct() { 
        $this->middleware('auth');
     }    


    public function index(){
        
        $template = ['title' => 'Claims',"subtitle"=>"Claims-List",
                     'scripts'=>[asset('admin/js/page/claim-list.js')]];
        $totalRecords =  DB::table("claims_assistance")->count(); 
        $template['claimCnt']  = $totalRecords;
        if($totalRecords){
            $query = DB::table("claims_assistance");
            $template['claims'] = $query->where('parentId',0)->orderBy("id", "DESC")
                 //->offset(0)
                 ->limit(10)->get();
        }
        return View::make('admin.claims.list')->with($template);
        
    }
    
//      public function getLeadsdatatable(Request $request){
//         $whr = array();$like=array();$or_like=array();$likeArr=array(); 
//         $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
//         $limit = $request->length;
//         $start = $request->start;
//         $order = $columns[$request->input('order.0.column')];
//         $dir = $request->input('order.0.dir');
//         $query = DB::table("app_quote");
        
//         $query->select('*');
//         $totalFiltered = $query->count();
//         //$query->orderBy($order, $dir)
//         $users = $query->orderBy("id", "DESC")
//             ->offset($start)
//             ->limit($limit)->get();
//         $totalRecords =  DB::table("app_quote")->count();
//         $result=[];$i=1;
//          foreach($users as $each){
//                  if($each->agent_id>0){
//                   $agentName = DB::table("agents")->where('id',$each->agent_id)->value('name');
//                   $agent= "<span class='text-success'>'.$agentName.'</span>";
//                  }else{
//                     $agent= "<span class='text-success'>Individual</span>";
//                  }
                 
//                  $suppName = DB::table("suppliers")->where('short','=',$each->provider)->value('name');
//                  $eachData=array();
//                  //$eachData['sno']        = "<strong>".$i."</strong>";
//                  $eachData['title']        = $each->title;
//                  $eachData['customer']       = '<a href="#" class="text-default">
// 													<div class="font-weight-semibold">'.$each->customer_mobile.'</div>
// 													<span class="text-muted" style="font-size: 12px;">'.ucwords(strtolower($each->customer_name)).'</span>
// 												 </a>';
//                  $eachData['proposalNumber']     =$each->proposalNumber;
//                  $eachData['premiumAmount']     =$each->premiumAmount;
//                  $eachData['insurance_type'] = $each->type;
//                  $eachData['param']      = '<a href="#" class="view-param" data-id="'.$each->id.'">view</a>';
//                  $eachData['provider']   = $suppName;
//                  $eachData['type']      = ($each->type)?$each->type:"<span class='text-danger'>Not available</span>";
//                  $eachData['date']       = date("jS M Y", strtotime($each->created_at));;
//                  $eachData['agent']      = $agent;
//                  $eachData['status']     = "-";
//                  $eachData['action']     = "-";
               
//                 $result[] = $eachData; 
              
//              $i++; 
//          }
//          $json_data = array(
//           "draw"            => intval($request->input('draw')),  
//           "recordsTotal"    => intval($totalRecords),  
//           "recordsFiltered" => intval($totalFiltered),  
//           "data"            => $result   
//           );
//         echo json_encode($json_data); 
//   }
   
   
//   function getLeadsDetails(Request $request){
//       $lead =  DB::table("leads")->where('id','=',$request->lead_id)->first();
//       $data['lead']= $lead;
//       if($lead->type=='HEALTH'){
//           return View::make('admin.sales.viewLeadDetails_health')->with($data);  
//       }else{
//           print_r($lead);
//           echo "Something went wrong try again";
//       }
//   }
   
}
 