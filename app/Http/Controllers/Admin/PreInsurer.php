<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;
use Illuminate\Support\Facades\Hash;
//use App\Utils\AppUtil;
class PreInsurer extends Controller{
     public function __construct() { 
       // $this->appUtil = $appUtil; 
        $this->middleware('auth');
     }    


    public function index(){
        $template = ['title' => 'Users',"subtitle"=>"Pre insurer List",'scripts'=>[asset('admin/js/page/pre-insurer.js')]];
        return View::make('admin.preinsurer.list')->with($template);
    }
    
    public function getDatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(0=>'id',1 =>'name',2=>'digit_code' ,'3'=>'type','4'=>'status'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
         
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
         
        
        $query = DB::table("previous_insurer")->select('*')
                ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name','LIKE', "%{$searchTerm}%")->orWhere('digit_code', 'LIKE', "%{$searchTerm}%");
                });
                
            
        $totalFiltered = $query->count();
        $insurers =  $query->orderBy($order, $dir)
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table("previous_insurer")->count();
        $result=[];$i=($start+1);
         foreach($insurers as $each){
                 $eachData=array();
                 $status = ($each->status=="ACTIVE")?'<a href="#" class="text-success">Active</a>':'<a href="#" class="text-danger">Inactive</a>';
                 $type = ($each->type!="")?($each->type=='HEALTH')?'<span class="text-success">HEALTH</span>':'<span class="text-primary">GENERAL</span>'
                                          :"N/A";
                 $eachData['sno']        = "<strong>".$i."</strong>";
                 $eachData['name']       = $each->name;
                 $eachData['digit_code'] = ($each->digit_code)?$each->digit_code:"<span class='text-danger'>N/A</span>";
                 $eachData['type']       = $type;
                 $eachData['status']     = "<span>".$status."<span>";
                 $btnEdit  = '<a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top"  title="Update Details" data-id="'.$each->id.'"  href="#" class="btn btn-primary edit-insurer"><i class="icon ion-compose"></i></a>';
                 
                 $eachData['action']    ='<div class="btn-group">'.$btnEdit.'</div>';
               
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
   
    public function createUpdateInsrerModel(Request $request){
         $template['param'] =$request->param;
         if(isset($request->id) && $request->param=="edit"){
            $template['data'] = DB::table("previous_insurer")->where('id',$request->id)->first();
          }
         return View::make('admin.preinsurer.model_create_edit')->with($template);
     }
     
    public function saveChangeInsurer(Request $request){
         $data['name'] = ucwords(strtolower($request->insurer_name));
         $data['digit_code'] = $request->insurer_digit_code;
         $data['type'] = $request->insurer_type;
         $data['status'] = $request->insurer_status;
         if(isset($request->insurerID)){
           DB::table('previous_insurer')->where('id',$request->insurerID)->update($data);
           $id = $request->insurerID;
           $param= "Updated";
         }else{
          $id = DB::table('previous_insurer')->insertGetId($data);
          $param= "Create";
          }
          if($id){
              return Response::json(array('status'=>'success','message'=>"Insurer Info {$param} successfully"));
          }else{
              return Response::json(array('status'=>'error','message'=>"Someting went wrong while {$param}"));
          }
        
    }
   
   
}
 

