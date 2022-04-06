<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;

use Meng\AsyncSoap\Guzzle\Factory;
use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;
use App\Resources\DigitCarResource;
use App\Resources\HdfcErgoCarResource;

class InsuredController extends Controller{
   
    public function __construct(Care $care,DigitHealth $digit,Manipal $manipal,HdfcErgoCarResource $HdfcErgoCarResource,DigitCarResource $DigitCarResource) { 
       $this->Care =  $care;
       $this->DigitHealth = $digit;
       $this->Manipal =  $manipal;
       
       $this->HdfcErgoCarResource =$HdfcErgoCarResource;
       $this->DigitCarResource = $DigitCarResource;
    }
   

    public function index(){
        
        $template = ['title' => 'Saled',"subtitle"=>"Saled List",
                     'scripts'=>[asset('admin/js/page/sales-insured.js')]];
        if(true){                
           return View::make('admin.sales.insured')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
     public function view(Request $request){
        
        $template = ['title' => 'Insured',"subtitle"=>"Insured Policy Details",
                     'scripts'=>[asset('admin/js/page/sales-view.js')]];
        if($request->input('policy')){             
        $template['info']=DB::table("policy_saled")->where('policy_no',$request->input('policy'))->first();
            if(true ){                
               return View::make('admin.sales.view')->with($template);
            }else{
               return View::make('admin.404')->with($template);
            }
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
   public function getInsureddatatable(Request $request){
        $whr = array();$like=array();$or_like=array();$likeArr=array(); 
        $columns = array( 0 =>'id', 1 =>'first_name',2=>'last_name' ,'3'=>'email','3'=>'is_active'); 
        $limit = $request->length;
        $start = $request->start;
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
         $policyNumber = ($request->input('columns.0.search.value'))?:"";
         $TransactionNumber = ($request->input('columns.1.search.value'))?:"";
         $customer = ($request->input('columns.2.search.value'))?:"";
        
        
        $query = DB::table("policy_saled");
        
        $query->select('*')
                ->when($policyNumber, function ($query, $policyNumber) {
                    return $query->where('policy_saled.policy_no','like', '%'.$policyNumber.'%');
                })
                ->when($TransactionNumber, function ($query, $TransactionNumber) {
                    return $query->where('policy_saled.transaction_no','like', '%'.$TransactionNumber.'%');
                })
                ->when($customer, function ($query, $customer) {
                    return $query->where('policy_saled.mobile_no','LIKE', "%{$customer}%")->orWhere('policy_saled.customer_name', 'LIKE', "%{$customer}%");
                });
        $totalFiltered = $query->count();
        //$query->orderBy($order, $dir)
        $users = $query->orderBy("id", "DESC")
            ->offset($start)
            ->limit($limit)->get();
        $totalRecords =  DB::table("policy_saled")->count();
        $result=[];$i=1;
         foreach($users as $each){
                 if($each->filename){
                    $fileOpt =   '<a  href="'.url('/get/download/file/policy-file/'.$each->filename).'" class="btn btn-dark  btn-icon mg-r-5 mg-b-10"><div><i class="fa fa-download"></i></div></a>';
                 }else{
                    $fileOpt =   '<a  data-id="'.$each->id.'"  href="#" class="get-policy-doc btn btn-dark  btn-icon mg-r-5 mg-b-10"><div><i class="fa fa-globe"></i></div></a>';
                 }
                 $customer  =  ($each->customer_id)?DB::table("customers")->where('id',$each->customer_id)->value('mobile'):"<span class='text-danger'>Not available</span>";
                 $supplier  =  ($each->provider)?DB::table("our_partners")->where('shortName','=',$each->provider)->value('name'):"<span class='text-danger'>Not available</span>";
                 $eachData=array();
                 $eachData['transaction_no']  = "<span style='font-size: 13px;'>#".$each->transaction_no."</span>";
                 $eachData['policy_no']       = "<a style='' class='get-policy-overview' data-id='".$each->id."' data-no='".$each->policy_no."' href='#'>".($each->policy_no)."</a>";
                 $eachData['amount']          = "₹".$each->amount."/-";
                 $eachData['type']            = $each->type;
                 $eachData['provider']        = '<span class="tx-12">'.$supplier.'</span>';
                 $eachData['customer']        = '<a href="#" class="text-default">
													<div class="font-weight-semibold">'.$each->mobile_no.'</div>
													<span class="text-muted" style="font-size: 12px;">'.ucwords(strtolower($each->customer_name)).'</span>
												 </a>';
              //   $eachData['file']            = $fileOpt;//($each->filename)?"<a href='".url('/get/download/file/policy-file/'.$each->filename)."'>Download</a>":"<span class='text-danger'>Not available</span>";
                 $eachData['date']            = '<span style="font-size: 12px;">'.date("jS M Y", strtotime($each->date)).'</span>';  
              //   $eachData['policy_status']   = ($each->policy_status=='Pending')?"<span class='text-warning tx-12'>Pending</span>":"<span class='text-success tx-12'>Completed</span>";
              //   $eachData['payment_status']  = ($each->payment_status=='Pending')?"<span class='text-warning tx-12'>Pending</span>":"<span class='text-success tx-12'>Completed</span>";
                 
           
                 
                 
                 $eachData['action']          = $fileOpt.' <a  href="'.url('sales/insured/view?policy='.$each->policy_no).'" class="btn btn-danger btn-icon mg-r-5 mg-b-10"><div><i class="fa fa-eye"></i></div></a>';//$action;
               
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
   
   public function getPolicyPdf(Request $request){
       if($request->policyid){
           $count = DB::table("policy_saled")->where('id',$request->policyid)->count();
           if($count){
               $policy = DB::table("policy_saled")->where('id',$request->policyid)->first();
               $json = json_decode($policy->json_data);
               if($policy->provider=='DIGIT' && $policy->type=='HEALTH'){
                   $res = $this->DigitHealth->GetPDF($policy->policy_no);
                  if($res->status && $res->filename!=""){
                      $docData['proposal'] = ($res->status)?$res->proposal:"";
                      $docData['ecard'] = ($res->status)?$res->ecard:"";
                      $docData['filename']=($res->status)?$res->filename:"";
                          $refID = DB::table('policy_saled')->where(['id'=>$request->policyid])->update($docData);
                          $btnDownload =""; $PatheCard = ""; $pathProposal="";
                        if($res->filename!=""){
                           $btnDownload =  url('/get/download/file/policy-file/'.$res->filename);
                        }                  
                        if($res->ecard!=""){ $PatheCard =url('/get/download/file/policy-ecard/'.$each->ecard); }
                        if($res->proposal!=""){ $pathProposal =url('/get/download/file/policy-proposal/'.$each->proposal); }
                        return Response::json(['status'=>'success','message'=>'Policy document get successfully!','filePath'=>$btnDownload,'eCardPath'=>$PatheCard,'proposalPath'=>$pathProposal]);
                  }else{
                      return Response::json(['status'=>'error','message'=>'Unable to get policy try again!']); 
                  }
               }else if($policy->provider=='DIGIT' && ($policy->type=='BIKE' || $policy->type=='CAR') ){
                   if(isset($json->applicationId)){
                       $applicationId = $json->applicationId;
                   }else{
                      $tmp = DB::table("app_quote")->where('enquiry_id',$policy->enquiry_id)->first(); 
                      $json = json_decode($tmp->json_create);
                      $applicationId = $json->applicationId;
                   }
                   $res = $this->DigitCarResource->GetPDF($policy->policy_no,$applicationId);
                   if($res->status && $res->filename!=""){
                          $refID = DB::table('policy_saled')->where(['id'=>$request->policyid])->update(['filename'=>$res->filename]);
                          $btnDownload =  url('/get/download/file/policy-file/'.$res->filename);
                        return Response::json(['status'=>'success','message'=>'Policy document get successfully!','filePath'=>$btnDownload]);
                  }else{
                      return Response::json(['status'=>'error','message'=>'Unable to get policy try again!']); 
                  }
               }else if($policy->provider=='HDFCERGO' && ($policy->type=='BIKE' || $policy->type=='CAR') ){
                   
                        $resp = ($policy->type=="BIKE")?$this->HdfcErgoTwResource->GetPDF($policy->policy_no):$this->HdfcErgoCarResource->GetPDF($policy->policy_no);
                         if($resp['status']){
                             DB::table('policy_saled')->where('policy_no', $policy->policy_no)->update(['filename'=>$resp['filename']]);
                             return Response::json(['status'=>'success','message'=>"Policy document get successfully!",'filePath'=>url('get/download/file/policy-file/'.$resp['filename'])]); 
                         }else{
                            return Response::json(['status'=>'error','fileName'=>"",'message'=>$resp['message']]);  
                         }
                   
                  
               }else if($policy->provider=='MANIPAL_CIGNA'){
                   $res = $this->Manipal->GetPDF($policy->policy_no,$policy,true);
                   if($res['status']){
                           $refID = DB::table('policy_saled')->where(['id'=>$request->policyid])->update(['filename'=>$res['filename']]);
                           $btnDownload =  url('/get/download/file/policy-file/'.$res['filename']);
                        return Response::json(['status'=>'success','message'=>'Policy document get successfully!','filePath'=>$btnDownload]);
                   }else{
                      return Response::json(['status'=>'error','message'=>'Unable to get policy try again!']); 
                   }
               }else if($policy->provider=="CARE"){
                        
                $resp = $this->Care->savePDF($policy->enquiry_id,$policy->policy_no);
                if($resp['status']=='success'){
                     $refID = DB::table('policy_saled')->where(['id'=>$request->policyid])->update(['filename'=>$resp['filename']]);
                     $btnDownload =  url('/get/download/file/policy-file/'.$res['filename']);
                     return Response::json(['status'=>'success','message'=>'Policy document get successfully!','filePath'=>$btnDownload]);
                }else{
                  return response()->json(['status'=>'error','message'=>'Policy document not generated!']); 
                }
             }else{
                    return Response::json(['status'=>'error','message'=>'Invalid Provider']); 
               }
           }else{
              return Response::json(['status'=>'error','message'=>'Policy details not found.']);
           }
       }else{
           return Response::json(['status'=>'error','message'=>'Trying to get invalid policy access!']);
       }
   }
   
   public function policyOverviewModal(Request $request){
       $id  = $request->policyid;
       $data['res'] = DB::table("policy_saled")->where('id',$id)->first();
       return View::make('admin.sales.modal_policy_details')->with($data);
     }
   
}
 

