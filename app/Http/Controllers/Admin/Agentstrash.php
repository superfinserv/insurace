<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use App\Model\Agents;
use App\Model\Categories;
use File;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Resources\Posp;

class Agentstrash extends Controller{
      public function __construct(Posp $posp) { 
          $this->Posp = $posp;
          $this->middleware('auth');
     }     


     public function index(){
        
        $template = ['title' => 'POSP',"subtitle"=>"POSP trash List",
                     'scripts'=>[asset('admin/js/page/agents-trash.js')]];
        if(true){                
        return View::make('admin.agents.agents_trash')->with($template);
      }else{
        return View::make('admin.404')->with($template);
      }
    }

    
     
     public function getAgentsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $statusTerm = ($request->input('columns.2.search.value'))?:"";
        $testTerm = ($request->input('columns.3.search.value'))?:"";
        
        $query = Agents::query(); 
        
        $query->select('*')->where('is_trashed','YES')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('name','LIKE', "%{$searchTerm}%")->orWhere('email', 'LIKE', "%{$searchTerm}%")->orWhere('mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('posp_ID', "LIKE","%{$pospTerm}%");
                })
              ->when($statusTerm, function ($query, $statusTerm) {
                  if($statusTerm=='VERIFIED'){
                    return $query->where('isVerified', "=",1);
                  }else if($statusTerm=='UNDR_VRF'){
                     return $query->where(['isProceedSign'=>1,'isVerified'=>'0']);
                  }else if($statusTerm=='OTHR'){
                     return $query->where(['isProceedSign'=>0,'isVerified'=>'0']);
                  }
                 
                })
              ->when($testTerm, function ($query, $testTerm) {
                  if($testTerm=='ALLOWED'){
                     return $query->where('isTestAllow', "=",1);
                  }else if($testTerm=='BLOCKED'){
                     return $query->where(['isTestAllow'=>0,'is_tranning_complete'=>'YES']);
                  }else if($testTerm=='UNDR_TRN'){
                     return $query->where(['isTestAllow'=>0,'is_tranning_complete'=>'NO']);
                  }
              });
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  Agents::where('is_trashed','YES')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
               $profile =  $this->Posp->profileCompleteData($each['id']);
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['name']         = ($each['name'])?ucwords(strtolower($each['name'])):"<span class='text-danger'>Not available</span>";
                 $eachData['mobile']      = $each['mobile'];
                 $eachData['email']      = ($each['email'])?strtolower($each['email']):"<span class='text-danger'>Not available</span>";
                 $eachData['code'] =($each['posp_ID']!="")?"<span class='text-success'>".$each['posp_ID']."</span>":"<span class='text-danger'>Pending</span>";
                $certification_count = DB::table('certification')->where('agent_id', $each['id'])->orderBy('id', 'desc')->count();
                if($certification_count){
                    $certification = DB::table('certification')->where('agent_id', $each['id'])->orderBy('id', 'desc')->first();
                    $certificate_link=url('/get/download/file/test-certificate/'.$certification->file);
                    $eachData['certificate_link']=(round($certification->obtained_marks)>=50)?'<a class="btn btn-sm btn-dark" href="'.$certificate_link.'" target="_blank" data-id="'.$certification->id.'"><i class="fa fa-download"></i> Download</a>':'<span class="text=danger">'.$certification_count.'- attempt</span>';
                }else{
                   $eachData['certificate_link'] ="<span class='text-warning'>Not attempted</span>";
                }
                $eachData['created_at']   = $each['created_at'];
                if($each['is_tranning_complete']=='YES'){
                  $eachData['isTestAllow'] =($each['isTestAllow'])?"<small class='text-success'>Allowed</small>"
                                                                 :"<small class='text-danger'>Blocked</small>";
                }else{
                     $eachData['isTestAllow'] = "<small class='text-warning'>Under Training</small>";
                }
                if($profile['iscomplete']==0 && $profile['payment_status']==0 && $profile['isProceedSign']==0 && $profile['isVerified']==0){
                    if($profile['complete']>50){$bg =" bg-success";}
                    else if($profile['complete']>30 && $profile['complete']<=50){$bg =" bg-warning";}
                    else{$bg =" bg-danger";}
                    
                    $status = '<div class="progress ht-15">
                                  <div class="progress-bar '.$bg.'" style="font-size:12px;width:'.$profile['complete'].'%" role="progressbar" aria-valuenow="'.$profile['complete'].'" aria-valuemin="0" aria-valuemax="100">'.$profile['complete'].'%</div>
                                </div>';
                     //$status =  "<small class='text-warning'>Incomplete Profile(".$profile['complete']."%)</small>";
                }else if($profile['iscomplete']==1 && $profile['payment_status']==0 && $profile['isProceedSign']==0 && $profile['isVerified']==0){
                     $status =  "<small class='text-warning'>Fee Pending</small>";
                }else if($profile['iscomplete']==1 && $profile['payment_status']==1 && $profile['isProceedSign']==1 && $profile['isVerified']==0){
                     $status =  "<small class='text-warning'>Under verification</small>";
                }else if($profile['iscomplete']==1 && $profile['payment_status']==1 && $profile['isProceedSign']==1 && $profile['isVerified']==1){
                    $status =  "<span class='text-success'><i class='fa fa-check tx-success mg-r-5'></i>verified</span>";
                }else{
                   $status =  "<small class='text-danger'>Not verified</small>";
                }
                $eachData['status'] = $status;
                
          $buttons ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each['id'].'" data-name="'.$each['name'].'" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Reset password"  href="#" data-id="'.$each['id'].'"  class="btn btn-dark reset-password" ><i class="icon ion-key"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update details" target="_blank"  href="'.url('/agent/edit/personal/'.$each['id']).'" class="btn btn-primary"><i class="icon ion-gear-a"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="View details"  href="'.url('/agentinfo/'.$each['id']).'" class="btn btn-success"><i class="icon ion-clipboard"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Undo to trash" data-id="'.$each['id'].'" data-name="'.$each['name'].'"  href="#" class="btn btn-danger btn-trash"><i class="icon ion-trash-b"></i></a>
                    </div>';
              if(true){ 
                $eachData['action']          = $buttons;  
              }else{
                $eachData['action']="";
              }
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
 

