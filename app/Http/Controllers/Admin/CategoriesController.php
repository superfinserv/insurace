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

class CategoriesController extends Controller
{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }


    public function index(){
         $template = ['title' => 'Supersolutions :: Categories',"subtitle"=>"List Categories",
                     'scripts'=>[asset('admin/js/page/categories.js')]];
        return View::make('admin.categories.categories')->with($template);
    }
    
    
    // function logm(){
    //         $agentData = DB::table('agents')->where('payment_status',1)->get();
    //          //$agentData = DB::table('agents')->get();
    //          foreach($agentData as $agent){
    //              $pay= DB::table('agent_payments')->where('agent_id',$agent->id)->first(); 
    //              //print_r($pay);
    //              DB::table('agent_activity_log')->insertGetId(['agent_id'=>$agent->id,'action'=>'FEE','log_message'=>'Fee received of '.$pay->total_amount.'/-','created_at'=>$pay->transaction_date]);
    //          }
    //     }
    
    public function getCategoriesdatatable(Request $request){
        $columns = array( 0 =>'name', 3 =>'sno',4 =>'msno',5=>'on_front',7=>'status'); 
        $limit = $request->length;
        $start = $request->start;
        
          $order = $columns[$request->input('order.0.column')];
          $dir = $request->input('order.0.dir');
        
         $regionsName = ($request->input('columns.0.search.value'))?:"";
         $regionsDesc = ($request->input('columns.1.search.value'))?:"";
           
        $query = DB::table('categories');
        $query->select('*')
              ->when($regionsName, function ($query, $regionsName) {
                    return $query->where('name','like', '%'.$regionsName.'%');
                })
              ->when($regionsDesc, function ($query, $regionsDesc) {
                    return $query->where('description','like', '%'.$regionsDesc.'%');
                });
        $totalFiltered = $query->count();
        $brands = $query->orderBy($order,$dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('categories')->count();
        $result=[];$i=1;
         foreach($brands as $each){
                 $eachData=array();
                $Iconurl = getAssets('site_assets/app_icons/category_icon/'.$each->mobile_icon);
                $eachData['name']        = $each->name;
                $eachData['icon']         = "<i style='color:#AC0F0B' class='".$each->icon_class."'></i>";
                $eachData['serial']         = $each->sno;
                $eachData['mserial']         = $each->msno;
                $eachData['type']         = $each->type;
                $eachData['appIcon']         = '<img src="'.$Iconurl.'" class="wd-36" alt="'.$each->name.'">';
               
                $eachData['Isfront'] =($each->on_front)?'<div class="btn-status" data-name="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->on_front.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11">Yes</span> </div>'
                                                       :'<div class="btn-status" data-name="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->on_front.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11">No</span> </div>';
                
                $eachData['status'] =($each->status)?'<div class="btn-status" data-name="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-success pd-y-3 pd-x-10 tx-white tx-11 ">Active</span> </div>'
                                                    :'<div class="btn-status" data-name="'.$each->name.'" data-id="'.$each->id.'" data-status="'.$each->status.'"><span class="bg-danger pd-y-3 pd-x-10 tx-white tx-11">Inactive</span> </div>';
                $eachData['action']          = '-';  
             
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
   
    public function statusUpdate(Request $request){
      $is = DB::table('regions')->where('id',$request->id)->update(['status'=>$request->status]);
      if(1){
          return Response::json(['status'=>'success','message'=>'status updated successfully']);
      }else{
          return Response::json(array('status'=>'error','message'=>'something went wrong!'));
      }
    }
    
    public function categoriesSave(Request $request){
      $data['name']=$request->regionName;
      $data['description']=$request->regionDesc;
     $id = DB::table('regions')->insertGetId($data);
      if($id){
           return Response::json(array('status'=>'success','message'=>"Regions `".$request->regionName."` created successfully"));
        }else{
           return Response::json(array('status'=>'error','message'=>"Something went wrong while createing Region."));
        }
  } 
  
    public function createPolicy(){
        $categories = DB::table('categories')->where('status',1)->get();
        $template = ['title' => 'Supersolutions :: Policy',"subtitle"=>"Create Policy","categories"=>$categories,
                     'scripts'=>[asset('admin/js/page/create-policy.js')]];
        return View::make('admin.sales.categories')->with($template);
    }
    
    
    
    public function redirectPolicyPage(Request $request){
        if($request->id){
            $cat = DB::table('categories')->where('id',$request->id)->first();
            $activeArr = ["health-insurance",'car-insurance'];
            if (in_array($cat->slug, $activeArr)){
                 return Response::json(['status'=>'success','message'=>"Redirecting to create {$cat->name} policy","url"=>$cat->slug]);
            }else{
              return Response::json(['status'=>'error','message'=>"{$cat->name} is under devlopment","url"=>null]);
            }
            
        }else{
           return Response::json(['status'=>'error','message'=>"unknown request found!","url"=>null]); 
        }
    }

}
 

