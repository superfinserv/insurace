<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use File;
use Auth;
use Carbon\Carbon;
use App\Exports\PolicyExport;
use Maatwebsite\Excel\Facades\Excel;

use Meng\AsyncSoap\Guzzle\Factory;
use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;
use App\Resources\DigitCarResource;
use App\Resources\HdfcErgoCarResource;
use App\Resources\FgiTwResource;

class InsuredController extends Controller{
   
    public function __construct(Care $care,DigitHealth $digit,Manipal $manipal,HdfcErgoCarResource $HdfcErgoCarResource,DigitCarResource $DigitCarResource) { 
       $this->Care =  $care;
       $this->DigitHealth = $digit;
       $this->Manipal =  $manipal;
    
       $this->FgiTw =  new FgiTwResource;
       $this->HdfcErgoCarResource =$HdfcErgoCarResource;
       $this->DigitCarResource = $DigitCarResource;
    }
    
    public function exportExcel(Request $request)   { 
        $from_date=$request->input('from_date');
        $to_date = $request->input('to_date');
        $type = ($request->input('type')=="ALL")?"":$request->input('type');
        $partner = ($request->input('partner')=="ALL")?"":$request->input('partner');
        
        return Excel::download(new PolicyExport($from_date,$to_date,$type,$partner), 'Policy-Report.xlsx');  
    }
   

    public function index(){
        
        $template = ['title' => 'SOLD',"subtitle"=>"Insured List",
                     'scripts'=>[asset('admin/js/page/sales-insured.js')]];
        if(true){                
           return View::make('admin.sales.insured')->with($template);
        }else{
           return View::make('admin.404')->with($template);
        }
    }
    
     public function addNewSoldPolicy(Request $request){
        
        $template = ['title' => 'Insured'];
        if($request->param=="motor"){
           $template['scripts'] = [asset('admin/js/page/add-motor-sales-insured.js')];  
           $template['subtitle'] = "Add new motor policy";
           $page = 'admin.sales.add_motor_insured';
       }else if($request->param=="health"){
            $template['scripts'] = [asset('admin/js/page/add-health-sales-insured.js')];  
            $template['subtitle'] = "Add new health policy";
            $page = 'admin.sales.add_health_insured';
       }else{
            $template['scripts'] = [asset('admin/js/page/add-motor-sales-insured.js')];  
            $template['subtitle'] = "Add new motor policy";
           
            $page = 'admin.sales.add_motor_insured';
       }
       $template['insurer']  = DB::table('our_partners')->get();
       $template['states']  = DB::table('states')->get();
      // $template['relations'] = DB::table('relations')->get();
       $template['posps']  = DB::table('agents')->where('status','Inforce')->get();
        return View::make($page)->with($template);
    }
    
    
    
     public function saveNewPolicy(Request $request){
                $Arr['policy_no']=$request->policy_no;
                $Arr['transaction_no']=$request->tranaction_no;
                $Arr['customer_name']=$request->customer_name;
                $Arr['mobile_no']=$request->customer_no;
                $Arr['policyType']=$request->policyType;
                $Arr['provider']=$request->insPartner;
                $Arr['startDate']=Carbon::CreateFromFormat('d/m/Y',$request->startDate)->format('Y-m-d');
                $Arr['endDate']=Carbon::CreateFromFormat('d/m/Y',$request->endDate)->format('Y-m-d');
                $agnt = DB::table('agents')->where('id',$request->pospId)->get();
                if($agnt->userType=='POSP'){
                    $Arr['agent_id']=$request->pospId;
                    $Arr['sp_id'] = ($agnt->mapped_sp)?$agnt->mapped_sp:0;
                }else{
                    $Arr['agent_id']=$request->pospId;
                    $Arr['sp_id'] = $request->pospId;  
                }
                $Arr['policyFrom'] = "Manual";
                $Arr['netAmt']=$request->total_net;
                $Arr['taxAmt']=$request->total_tax;
                $Arr['grossAmt']=$request->total_gross;
                $Arr['amount'] = $request->total_gross;
                $Arr['date'] = Carbon::CreateFromFormat('d/m/Y',$request->loginDate)->format('Y-m-d');
                if($request->param=='motor'){
                      $vMake=$request->vMake;
                      $vModel=$request->vModel;
                      $Arr['type']=$request->policyFor;
               
                        $tp =  new \stdClass();
                        $tp->title = "Third Party";
                        $tp->code = "TP";
                        $tp->selection = false;
                        $tp->grossAmt = 0.00;
                        $tp->netAmt   = 0.00;
                        $tp->discount = 0.00;
                        $tp->tax = 0.00;
                        
                        $od =  new \stdClass();
                        $od->selection = false;
                        $od->title = "Motor Own Damage";
                        $od->code = "OD";
                        $od->grossAmt = 0.00;
                        $od->netAmt   = 0.00;
                        $od->discount = 0.00;
                        $od->tax = 0.00;
                        
                        if($request->policyType=="COM" || $request->policyType=="TP"){
                             $tp->selection = true;
                             $tp->grossAmt = $request->netTP;
                             $tp->netAmt   = $request->netTP;
                        }
                        
                        if($request->policyType=="COM" || $request->policyType=="OD"){
                            $od->selection = true;
                            $od->grossAmt = $request->netOD;
                            $od->netAmt   = $request->netTP;
                        }
                    
                       
                        
                        $pa_od =  new \stdClass();
                        $pa_od->title = "PA(Personal Accident) Owner Driver";
                        $pa_od->code = "PA_OWNER";
                        $pa_od->insuredValue  = 100000;
                        $pa_od->selection = ($request->PA_OwnerDriverCover)?true:false;
                        $pa_od->grossAmt = ($request->PA_OwnerDriverCover)?$request->PA_OwnerDriverCoverAmt:0.00;
                        $pa_od->netAmt   = ($request->PA_OwnerDriverCover)?$request->PA_OwnerDriverCoverAmt:0.00;
                        $pa_od->discount = 0.00;
                        $pa_od->tax = 0.00;
                        
                        $pa_un_pass =  new \stdClass();
                        $pa_un_pass->title = "PA cover for Unnamed Passenger";
                        $pa_un_pass->code  = "PA_UNNAMMED_PASS";
                        $pa_un_pass->insured  = 1;
                        $pa_un_pass->insuredValue  = 100000;
                        $pa_un_pass->selection = ($request->isPA_UNPassCover)?true:false;
                        $pa_un_pass->grossAmt = ($request->isPA_UNPassCover)?$request->isPA_UNPassCoverAmt:0.00;
                        $pa_un_pass->netAmt   = ($request->isPA_UNPassCover)?$request->isPA_UNPassCoverAmt:0.00;
                        $pa_un_pass->discount = 0.00;
                        $pa_un_pass->tax = 0.00;
                        
                        $pa_paid_driver =  new \stdClass();
                        $pa_paid_driver->title = "PA cover for Paid Driver";
                        $pa_paid_driver->code  = "PA_PAID_DRIVER";
                        $pa_paid_driver->insured  = 1;
                        $pa_paid_driver->insuredValue  = 100000;
                        $pa_paid_driver->selection = ($request->isPA_UNDriverCover)?true:false;
                        $pa_paid_driver->grossAmt = ($request->isPA_UNDriverCover)?$request->isPA_UNDriverCoverAmt:0.00;
                        $pa_paid_driver->netAmt   = ($request->isPA_UNDriverCover)?$request->isPA_UNDriverCoverAmt:0.00;
                        $pa_paid_driver->discount = 0.00;
                        $pa_paid_driver->tax = 0.00;
                        
                        $ll_un_pass =  new \stdClass();
                        $ll_un_pass->title = "Legal Liability to Unnamed passenger";
                        $ll_un_pass->code  = "LL_UN_PASS";
                        $ll_un_pass->insured  = 1;
                        $ll_un_pass->selection = ($request->isLL_UNPassCover)?true:false;
                        $ll_un_pass->grossAmt = ($request->isLL_UNPassCover)?$request->isLL_UNPassCoverAmt:0.00;
                        $ll_un_pass->netAmt   = ($request->isLL_UNPassCover)?$request->isLL_UNPassCoverAmt:0.00;
                        $ll_un_pass->discount = 0.00;
                        $ll_un_pass->tax = 0.00;
                        
                        $ll_emp =  new \stdClass();
                        $ll_emp->title = "Legal Liability to Employees";
                        $ll_emp->code  = "LL_EMP";
                        $ll_emp->insured  = 1;
                        $ll_emp->selection = ($request->isLL_EmpCover)?true:false;
                        $ll_emp->grossAmt = ($request->isLL_EmpCover)?$request->isLL_EmpCoverAmt:0.00;
                        $ll_emp->netAmt   = ($request->isLL_EmpCover)?$request->isLL_EmpCoverAmt:0.00;
                        $ll_emp->discount = 0.00;
                        $ll_emp->tax = 0.00;
                        
                        $ll_paid_driver =  new \stdClass();
                        $ll_paid_driver->title = "Legal Liability to Paid Driver";
                        $ll_paid_driver->code  = "LL_PAID_DRIVER";
                        $ll_paid_driver->insured  = 1;
                        $ll_paid_driver->selection = ($request->isLL_PaidDriverCover)?true:false;
                        $ll_paid_driver->grossAmt = ($request->isLL_PaidDriverCover)?$request->isLL_PaidDriverCoverAmt:0.00;
                        $ll_paid_driver->netAmt   = ($request->isLL_PaidDriverCover)?$request->isLL_PaidDriverCoverAmt:0.00;
                        $ll_paid_driver->discount = 0.00;
                        $ll_paid_driver->tax = 0.00;
                         
                         
                         $addons = [];$params = [];
                         if($request->isCngKitCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "CNG Kit Cover";
                               $eachAddon->code    = "isCngKitCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isCngKitCoverAmt;
                               $eachAddon->netAmt  = $request->isCngKitCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isElecAccCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Electrical Accessories";
                               $eachAddon->code    = "isElecAccCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isElecAccCoverAmt;
                               $eachAddon->netAmt  = $request->isElecAccCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isNonElecAccCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Non Electrical Accessories";
                               $eachAddon->code    = "isNonElecAccCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isNonElecAccCoverAmt;
                               $eachAddon->netAmt  = $request->isNonElecAccCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isBreakDownAsCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Road Side Assistance";
                               $eachAddon->code    = "isBreakDownAsCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isBreakDownAsCoverAmt;
                               $eachAddon->netAmt  = $request->isBreakDownAsCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isPersonalBelongCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Personal Belongings";
                               $eachAddon->code    = "isPersonalBelongCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isPersonalBelongCoverAmt;
                               $eachAddon->netAmt  = $request->isPersonalBelongCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isKeyLockProCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Key and Lock Protect";
                               $eachAddon->code    = "isKeyLockProCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isKeyLockProCoverAmt;
                               $eachAddon->netAmt  = $request->isKeyLockProCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isPartDepProCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Zero Dep";
                               $eachAddon->code    = "isPartDepProCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isPartDepProCoverAmt;
                               $eachAddon->netAmt  = $request->isPartDepProCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isConsumableCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Consumable cover";
                               $eachAddon->code    = "isConsumableCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isConsumableCoverAmt;
                               $eachAddon->netAmt  = $request->isConsumableCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isEng_GearBoxProCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Engine and Gear Box Protect";
                               $eachAddon->code    = "isEng_GearBoxProCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isEng_GearBoxProCoverAmt;
                               $eachAddon->netAmt  = $request->iisEng_GearBoxProCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isCashAllowCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Cash Allowance Cover";
                               $eachAddon->code    = "isCashAllowCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isCashAllowCoverAmt;
                               $eachAddon->netAmt  = $request->isCashAllowCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isTyreProCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Tyre Protect";
                               $eachAddon->code    = "isTyreProCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isTyreProCoverAmt;
                               $eachAddon->netAmt  = $request->isTyreProCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                         if($request->isRetInvCover){
                               $eachAddon =   new \stdClass();
                               $eachAddon->title   = "Return to Invoice";
                               $eachAddon->code    = "isRetInvCover";
                               $eachAddon->insured = "";
                               $eachAddon->grossAmt= $request->isRetInvCoverAmt;
                               $eachAddon->netAmt  = $request->isRetInvCoverAmt;
                               array_push($addons,$eachAddon);
                         }
                        
                            $covers = new \stdClass();
                            $covers->od = $od;
                            $covers->tp = $tp;
                            $covers->pa_owner = $pa_od;
                            $covers->pa_driver = $pa_paid_driver;
                            $covers->pa_passanger = $pa_un_pass;
                            $covers->ll_passanger = $ll_un_pass;
                            $covers->ll_driver = $ll_paid_driver;
                            $covers->ll_emp = $ll_emp;
                            $covers->addons = $addons;
                            $ncbArr = ["ZERO"=>0,'TWENTY'=>20,'TWENTY_FIVE'=>25,'THIRTY_FIVE'=>35,'FORTY_FIVE'=>45,'FIFTY'=>50];
                             $discount = new \stdClass();
                             $discounts = [];$totalDis =0;
                                   if($request->ncbDiscount){
                                         $eachDis =   new \stdClass();
                                         $eachDis->type   = 'NCB_DISCOUNT';
                                         $eachDis->amount = $request->ncbDiscountAmt;
                                         $eachDis->percent = ($request->ncbDiscountPercent)?$ncbArr[$request->ncbDiscountPercent]:0;
                                         array_push($discounts,$eachDis);
                                         $totalDis+= $request->ncbDiscountAmt;
                                     }
                                    if($request->otherDiscount){
                                         $eachDis =   new \stdClass();
                                         $eachDis->type   = 'SPECIAL_DISCOUNT';
                                         $eachDis->amount = $request->otherDiscountAmt;
                                         $eachDis->percent = 0;
                                         array_push($discounts,$eachDis);
                                         $totalDis+= $request->otherDiscountAmt;
                                     }
                    
                    $discount->discounts = $discounts;
                    $discount->total = $totalDis;
                    
                    $vehicle = new \stdClass(); 
                    $vehicle->idv = $request->vIdv;
                    
                    $obj = new \stdClass();
                    $obj->covers = $covers;
                    $obj->gross =  $request->total_gross;
                    $obj->net   =  $request->total_net;
                    $obj->tax   =  $request->total_tax;
                    
                    $obj->discount=  $discount;         
                    $obj->vehicle   =  $vehicle;    
                     
                    $Arr['json_data']=json_encode($obj); 
                
           
                    if($vMake){
                        $makeName = DB::table('vehicle_make_car')->where('id',$vMake)->value('make');
                        $params['vehicle']['brand'] = ['id'=>$vMake,'name'=>$makeName];
                    }
                    if($vModel){
                         $model = explode('-',$vModel);
                         $modalName = DB::table('vehicle_modal_car')->where('id',$model[1])->value('modal');
                         $params['vehicle']['modal'] = ['id'=>$vMake,'name'=>$modalName];
                        
                         $vName = DB::table('vehicle_variant_car')->where('id',$model[0])->value('variant');
                         $params['vehicle']['varient'] = ['id'=>$vMake,'name'=>$vName];
                     }
                     
                     
                     
                    $params['vehicle']['vehicleNumber'] = $request->vReg;
                    $params['vehicle']['engineNumber']  = $request->vEngine;
                    $params['vehicle']['chassisNumber']  = $request->vChassis;
                    $params['vehicle']['vehicleNumber']  = $request->vIdv;
                    $params['vehicle']['ncb']  = ($request->ncbDiscountPercent)?$request->ncbDiscountPercent:0;
                    $params['vehicle']['regDMY'] = Carbon::CreateFromFormat('d/m/Y',$request->regDate)->format('d-m-Y');
                    
                    $params['previousInsurance']['ncb']  = ($request->ncbDiscountPercent)?$request->ncbDiscountPercent:'ZERO';
                    
                    $params['customer']['first_name']  = $request->customer_name;
                    $params['customer']['last_name']  = $request->customer_name;
                    $params['customer']['mobile']  = $request->customer_no;
                    $params['customer']['email']  = "";
                    $params['customer']['dob']  = "";
                        
                    //$params['nominee']['name']  = $request->nomName;
                    //$params['nominee']['dob']  = Carbon::CreateFromFormat('d/m/Y',$request->nomDate)->format('d-m-Y');
                   // $params['nominee']['relation']  = $request->nomRelation;
                   
                    //$params['address']['addressLineOne'] = $request->vReg;
                   // $params['address']['addressLineTwo']  = $request->vEngine;
                   // $params['address']['state']  = $request->state;
                   // $params['address']['city']  = $request->city;
                   // $params['address']['pincode']  = $request->pincode;
                    
                    $Arr['params'] = json_encode($params);
                }// if motor end
                if($request->param=='health'){
                    $Arr['type']='HEALTH'; 
                    $Arr['sumInsured'] =  $request->sumInsured;
                    $Arr['termYear'] =  $request->sumInsured;
                    
                   $PLAN = DB::table('plans')->where('id',$request->policyPlan)->first();
                   $Arr['policyProductName'] =  $PLAN->plan_name;
                   $Jd['cust_mobile'] =$request->customer_no;
                   $Jd['title'] = $PLAN->plan_name;
                   $Jd['product']=$PLAN->product;
                   $Jd['code']=$PLAN->code;
                   $Jd['sumInsured']=$request->sumInsured;
                   $Jd['amount']=$request->total_gross;
                   $Arr['json_data']=json_encode($Jd); 
                   
                   
                    $PIinfo["code"] = $PLAN->code;
                    $PIinfo["zone"] = "";
                    $PIinfo["title"] = $PLAN->plan_name;
                    $PIinfo["product"] = $PLAN->product;
                    $PIinfo["policyType"] = $request->policyType;

                    $Arr['product_info'] =  json_encode($PIinfo);
                    
                   
                    
                    
                  $premium_info["Addons"]= [];
                  $premium_info["Total_Tax"]=$request->total_tax;
                  $premium_info["Addons_Total"]= 0;
                  $premium_info["Base_Premium"]=$request->total_net;
                  $premium_info["Total_Premium"]= $request->total_gross;
                  $Arr['premium_info'] =  json_encode($premium_info);
                  

                }// if health end
            
            if($request->hasFile('policyFile')){
                 $fileNameToStore = $request->insPartner.'_'.$request->policyType.'-'.$request->policy_no.'.'.request()->policyFile->getClientOriginalExtension();
                 $path = 'assets/customers/policy/pdf';
                 $file = $request->file('policyFile');
                 \Storage::disk('assets')->putFileAs($path, $file, $fileNameToStore);
                 $Arr['filename'] = $fileNameToStore;
                 
            }
            
            $Arr['policy_status'] = 'Completed';
            $Arr['payment_status'] = 'Completed';
          $id = DB::table('policy_saled')->insertGetId($Arr);
          if($id){
               return response()->json(['status'=>'success','message'=>'Policy added successfully']);
          }else{
               return response()->json(['status'=>'error','message'=>'Something went wrong']);
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
                    $fileOpt =   '<a   target="_blank"   href="'.url('/get/download/file/policy-file/'.$each->filename).'" class="btn btn-dark  btn-icon mg-r-5 mg-b-10"><div><i class="fa fa-download"></i></div></a>';
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
                   
                  
               }else if($policy->provider=='FGI' && ($policy->type=='BIKE' || $policy->type=='CAR') ){
                   
                        //$resp = ($policy->type=="BIKE")?$this->FgiTw->GetPDF($policy->policy_no):$this->HdfcErgoCarResource->GetPDF($policy->policy_no);
                        $resp = $this->FgiTw->GetPDF($sale->policy_no);
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
 

