<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use App\Model\Agents;
use Carbon\Carbon;
use App\Utils\Posp;
use App\Utils\TaxInvoice;

class AgentTables extends Controller{
     public function __construct() { 
          $this->posp = new Posp;
          $this->taxinvoice = new TaxInvoice;
          $this->middleware('auth');
     }  
    
     public function getAgentsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'agents.id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $statusTerm = ($request->input('columns.2.search.value'))?:"";
        
        $query = Agents::query(); 
        
        $query->select('agents.*','states.name as state_name','cities.name as city_name')->where('is_trashed','No')->where('application_status','Approved')
                        ->leftJoin('states', 'states.id', '=', 'agents.state')
                        ->leftJoin('cities', 'cities.id', '=', 'agents.city')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('agents.name','LIKE', "%{$searchTerm}%")->orWhere('agents.email', 'LIKE', "%{$searchTerm}%")->orWhere('agents.mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('agents.posp_ID', "LIKE","%{$pospTerm}%");
                })
              ->when($statusTerm, function ($query, $statusTerm) {
                  return $query->where(['agents.status'=>$statusTerm]);
                });
              
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("agents.id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  Agents::where('agents.is_trashed','No')->where('agents.application_status','Approved')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
               
                $eachData=array();
                $certification_count = DB::table('certification')->where('agent_id', $each->id)->count();
                if($certification_count){
                    $crCount = DB::table('certification')->whereColumn('obtained_marks','>=','required_marks')->where('agent_id', $each->id)->count();
                    if($crCount){
                      $certification = DB::table('certification')->where('agent_id', $each->id)->whereColumn('obtained_marks','>=','required_marks')->orderBy('id', 'desc')->first();
                      $eachData['certificate_link'] = '<a href="'.url('/get/download/file/test-certificate/'.$certification->file).'">Download</a>';
                    }else{
                       $eachData['certificate_link'] ="<span class='text-warning'>Not Pass</span>";
                    }
                    
    
                }else{
                   $eachData['certificate_link'] ="<span class='text-warning'>Not Attampt</span>";
                }
                
                 $eachData['icon']          = '<img class="wd-50 rounded-circle" src="'.asset('public/assets/agents/profile/'.$each->profile).'" alt="Image">';
                 $eachData['name']         = '<div class=""><a href="#">'.ucwords(strtolower($each->name)).'</a></div>
                                             <div class=""><span>'.$each->posp_ID.'</span></div>';
                 $eachData['contact']      = '<div class=""><a href="#">'.$each->mobile.'</a></div>
                                             <div class=""><span>'.$each->email.'</span></div>';
                 $eachData['city'] = $each->city_name;
                 $eachData['state'] = $each->state_name;
               
                $eachData['created_at']   = $each['created_at'];
                
                $eachData['status'] = $each->status;
                
          $buttons ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each['id'].'" data-name="'.$each['name'].'" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Reset password"  href="#" data-id="'.$each['id'].'"  class="btn btn-dark reset-password" ><i class="icon ion-key"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update details" target="_blank"  href="'.url('/agent/edit/personal/'.$each['id']).'" class="btn btn-primary"><i class="icon ion-gear-a"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="View details"  href="'.url('/agentinfo/'.$each['id']).'" class="btn btn-success"><i class="icon ion-clipboard"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Move to trash"  data-param="Yes" data-id="'.$each['id'].'" data-name="'.$each['name'].'"  href="#" class="btn btn-danger btn-trash"><i class="icon ion-trash-a"></i></a>
                    </div>';
              if(true){ 
                $eachData['action'] = $buttons;  
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
   
     public function getAgentsTrashdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'agents.id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $statusTerm = ($request->input('columns.2.search.value'))?:"";
        
        $query = Agents::query(); 
        
        $query->select('agents.*','states.name as state_name','cities.name as city_name')->where('is_trashed','Yes')
                        ->leftJoin('states', 'states.id', '=', 'agents.state')
                        ->leftJoin('cities', 'cities.id', '=', 'agents.city')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('agents.name','LIKE', "%{$searchTerm}%")->orWhere('agents.email', 'LIKE', "%{$searchTerm}%")->orWhere('agents.mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('agents.posp_ID', "LIKE","%{$pospTerm}%");
                })
              ->when($statusTerm, function ($query, $statusTerm) {
                  return $query->where(['agents.status'=>$statusTerm]);
                });
              
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("agents.id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  Agents::where('agents.is_trashed','NO')->where('agents.application_status','Approved')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
               
                $eachData=array();
                $certification_count = DB::table('certification')->where('agent_id', $each->id)->count();
                if($certification_count){
                    $crCount = DB::table('certification')->whereColumn('obtained_marks','>=','required_marks')->where('agent_id', $each->id)->count();
                    if($crCount){
                      $certification = DB::table('certification')->where('agent_id', $each->id)->whereColumn('obtained_marks','>=','required_marks')->orderBy('id', 'desc')->first();
                      $eachData['certificate_link'] = '<a href="'.url('/get/download/file/test-certificate/'.$certification->file).'">Download</a>';
                    }else{
                       $eachData['certificate_link'] ="<span class='text-warning'>Not Pass</span>";
                    }
                    
    
                }else{
                   $eachData['certificate_link'] ="<span class='text-warning'>Not Attampt</span>";
                }
                
                 $eachData['icon']          = '<img class="wd-50 rounded-circle" src="'.asset('public/assets/agents/profile/'.$each->profile).'" alt="Image">';
                 $eachData['name']         = '<div class=""><a href="#">'.ucwords(strtolower($each->name)).'</a></div>
                                             <div class=""><span>'.$each->posp_ID.'</span></div>';
                 $eachData['contact']      = '<div class=""><a href="#">'.$each->mobile.'</a></div>
                                             <div class=""><span>'.$each->email.'</span></div>';
                 $eachData['city'] = $each->city_name;
                 $eachData['state'] = $each->state_name;
               
                $eachData['created_at']   = $each['created_at'];
                
                $eachData['status'] = $each->status;
                
          $buttons ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each->id.'" data-name="'.$each->name.'" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Reset password"  href="#" data-id="'.$each->id.'"  class="btn btn-dark reset-password" ><i class="icon ion-key"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update details" target="_blank"  href="'.url('/agent/edit/personal/'.$each->id).'" class="btn btn-primary"><i class="icon ion-gear-a"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="View details"  href="'.url('/agentinfo/'.$each->id).'" class="btn btn-success"><i class="icon ion-clipboard"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Undo to trash" data-param="No" data-id="'.$each->id.'" data-name="'.$each->name.'"  href="#" class="btn btn-danger btn-trash"><i class="icon ion-trash-b"></i></a>
                    </div>';
              if(true){ 
                $eachData['action'] = $buttons;  
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
    
     public function getApplicationsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'agents.id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $statusTerm = ($request->input('columns.2.search.value'))?:"";
        
        $query = Agents::query(); 
        
        $query->select('agents.*','states.name as state_name','cities.name as city_name')->where('is_trashed','NO')->whereIn('application_status',['Pending','Declined'])
                        ->leftJoin('states', 'states.id', '=', 'agents.state')
                        ->leftJoin('cities', 'cities.id', '=', 'agents.city')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('agents.name','LIKE', "%{$searchTerm}%")->orWhere('agents.email', 'LIKE', "%{$searchTerm}%")->orWhere('agents.mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('agents.application_no', "LIKE","%{$pospTerm}%");
                })
              ->when($statusTerm, function ($query, $statusTerm) {
                  return $query->where(['agents.status'=>$statusTerm]);
                });
              
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("agents.id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  Agents::where('agents.is_trashed','NO')->whereIn('agents.application_status',['Pending','Declined'])->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
               
                $eachData=array();
                
                
                 $eachData['sno']          = "<strong>".$i."</strong>";
                 $eachData['name']         = '<div class=""><a href="#">'.ucwords(strtolower($each->name)).'</a></div>
                                             <div class=""><span>'.$each->application_no.'</span></div>';
                 $eachData['contact']      = '<div class=""><a href="#">'.$each->mobile.'</a></div>
                                             <div class=""><span>'.$each->email.'</span></div>';
                 $eachData['city'] = $each->city_name;
                 $eachData['state'] = $each->state_name;
               
                $eachData['created_at']   = $each['created_at'];
                
                $eachData['status'] = $each->status;
                
          $buttons ='<div class="btn-group" role="group" aria-label="Action Buttons" data-id="'.$each['id'].'" data-name="'.$each['name'].'" >
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Reset password"  href="#" data-id="'.$each['id'].'"  class="btn btn-dark reset-password" ><i class="icon ion-key"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Update details" target="_blank"  href="'.url('/agent/edit/personal/'.$each['id']).'" class="btn btn-primary"><i class="icon ion-gear-a"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="View details"  href="'.url('/agentinfo/'.$each['id']).'" class="btn btn-success"><i class="icon ion-clipboard"></i></a>
                      <a style="padding: 5px 10px;" data-toggle="tooltip" data-placement="top" title="Move to trash" data-id="'.$each['id'].'" data-name="'.$each['name'].'"  href="#" class="btn btn-danger btn-trash"><i class="icon ion-trash-a"></i></a>
                    </div>';
              if(true){ 
                $eachData['action']          = $buttons ; 
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
   
     public function getPaymentsdatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array(  0 =>'agent_payments.id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        $searchTerm = ($request->input('columns.0.search.value'))?:"";
        $pospTerm = ($request->input('columns.1.search.value'))?:"";
        $transactionTerm = ($request->input('columns.2.search.value'))?:"";
        //$testTerm = ($request->input('columns.3.search.value'))?:"";
        
        $query = DB::table('agent_payments')->join('agents', 'agent_payments.agent_id', '=', 'agents.id'); 
        
        $query->select('agent_payments.*','agents.name as pospName','agents.posp_ID as pospId','agents.application_no as application_no')
               ->when($searchTerm, function ($query, $searchTerm) {
                    return $query->where('agents.name','LIKE', "%{$searchTerm}%")->orWhere('agents.email', 'LIKE', "%{$searchTerm}%")->orWhere('agents.mobile', 'LIKE', "%{$searchTerm}%");
                })
              ->when($pospTerm, function ($query, $pospTerm) {
                  return $query->where('agents.posp_ID', "LIKE","%{$pospTerm}%");
                })->when($transactionTerm, function ($query, $transactionTerm) {
                  return $query->where('agent_payments.transaction_id', "LIKE","%{$transactionTerm}%");
                });
              
              
        $totalFiltered = $query->count();
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table('agent_payments')->count();
        $result=[];$i=($start+1);
         foreach($users as $each){
                $eachData=array();
                $eachData['sno']          = "<strong>".$i."</strong>";
                $eachData['invoice']      = $each->invoice_no;
                $eachData['paymentId']    = $each->transaction_id;
                $eachData['pospName']     =  $each->pospName;
                $eachData['pospId']       = ($each->pospId!="")?$each->pospId:$each->application_no;
                $eachData['amount']       =  "₹".$each->total_amount;
                $eachData['date']         = Carbon::createFromFormat('Y-m-d H:i:s', $each->transaction_date)->format('M d ,Y');;
                $eachData['action']='<a target="_blank" href="'.url('agent/get-tax-invoice/'.$each->agent_id).'">Download</a>';
              
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