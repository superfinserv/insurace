<?php
namespace App\Http\Controllers\Motor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use File;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Resources\Signzy;
use App\Resources\DigitCarResource;
use App\Resources\HdfcErgoCarResource;
use App\Resources\FgiTwResource;

use App\VarientCar;
use App\VarientTw;
class MotorInsurance extends Controller
{
    public $uniqueToken;
    
    public function __construct(DigitCarResource $DigitCarResource ,HdfcErgoCarResource $HdfcErgoCarResource,Signzy $Signzy){ 
           $this->DigitCar   = $DigitCarResource; 
           $this->HdfcErgoCar= $HdfcErgoCarResource; 
            $this->FgiTw =  new FgiTwResource;
           $this->Signzy = $Signzy;
           
    }
    
     function GetVehicleRegistrationDetails(Request $request){
           
            $isExist = DB::table('vehicles_rc')->where('regNo',$request->vehicleNumber)->count();
            if($isExist){
               
                $result =   DB::table('vehicles_rc')->where('regNo',$request->vehicleNumber)->first();
                $response =  json_decode($result->json_result);
                $cc = (int)$response->result->vehicleCubicCapacity;
                $fuel =  $response->result->type;
                if(str_contains($fuel, '/')) { 
                   $F =  explode('/',$fuel);
                   $fuel = $F[0];
                }
                if(str_contains($response->result->model, 'MARUTI')) { 
                    $_searchStr = str_replace(strtoupper("MARUTI"),"",strtoupper($response->result->model));
                }else if(str_contains($response->result->model, 'TATA')) { 
                    $_searchStr = str_replace(strtoupper("TATA"),"",strtoupper($response->result->model));
                }else{
                     $_searchStr = strtoupper($response->result->model);//." ".$cc." ".$fuel;
                }
                 //working good
                 // $_searchStr = $response->result->model;//." ".$cc." ".$fuel;
                 if($request->type=="TW"){
                     $Varient = VarientTw::search($_searchStr,null, true)
                                          ->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                          ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                          ->first();
                        if(!isset($Varient->id)){
                         //echo "Not found";
                         $Varient = VarientTw::search($_searchStr,null, true)
                                              //->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                             // ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                              ->first();
                          }
                 }else{
                     $Varient = VarientCar::search($_searchStr,null, true)
                                              ->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                              ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                              ->first();
                     
                      if(!isset($Varient->id)){
                       //   echo "Not found";
                         $Varient = VarientCar::search($_searchStr,null, true)
                                              //->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                             // ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                          ->first();
                      }
                   // print_r($Varient);die;
                 }
                 
                 if(isset($Varient->id)){ // if model is found successfully
                        // Get pincode Info
                        $pin =  DB::table('pincode_masters')->select('state_id','city_id')->where('pincode',$response->result->splitPresentAddress->pincode)->first();
                        $address = [];
                       if(isset($pin->city_id) && $pin->city_id>0){
                               $city = DB::table('cities')->where('id',$pin->city_id)->first(); 
                               if(isset($city->id)){
                                 $address['city'] =$city->id."-".$city->name;
                               }
                           
                               $state  = DB::table('states')->where('id',$pin->state_id)->first();
                               
                               $address['state'] = $state->id."-".$state->name; 
                               
                       }
                        //$response->result->vehicleInsuranceUpto = '25/02/2022';
                        if($response->result->vehicleInsuranceUpto!="NA" && $response->result->vehicleInsuranceUpto!=""){
                                    $isExp = Carbon::createFromFormat('d/m/Y', $response->result->vehicleInsuranceUpto)->isPast();
                                    if($isExp){
                                        $TODAY = Carbon::now();
                                        $_startDate = $TODAY->format('Y-m-d');     
                                        $_endDate = Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('Y-m-d');
                                        
                                        
                                         $endDate=Carbon::parse($_endDate);
                                         $startDate=Carbon::parse($_startDate);
                                         
                                          $diff = $endDate->diffInDays($startDate);
                                          if($diff<=45){
                                              $preInsure['exp'] ="-45";
                                          }else if($diff>45 && $diff<=90){
                                              $preInsure['exp'] ="45-90";
                                          }else if($diff>90){
                                              $preInsure['exp'] ="+90";
                                          }else{
                                              $preInsure['exp'] ="0";
                                          }
                                         
                                    }else{
                                         $TODAY = Carbon::now();
                                         $_endDate = $TODAY->format('Y-m-d');
                                         $_startDate = Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('Y-m-d');
                                        
                                         $endDate=Carbon::parse($_endDate);
                                         $startDate=Carbon::parse($_startDate);
                                         
                                         $diff = $endDate->diffInDays($startDate);
                                         $preInsure['exp'] ="";
                                      }
                              $preInsure['expDate'] =  Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('d-m-Y');
                        }else{
                            $isExp =  true;
                        }
                        if($response->result->vehicleInsuranceCompanyName!="NA"){
                             $pre = explode(' ',$response->result->vehicleInsuranceCompanyName)[0];
                             $PreSQL = DB::table('previous_insurer')->where('name','like',$pre."%");
                             if($PreSQL->count()){
                                 $PREINS =  $PreSQL->first();
                                 $preInsure['insurer'] =  $PREINS->id;
                            }else{
                                $preInsure['insurer'] = ""; 
                            }
                        }else{
                           $preInsure['insurer'] = ""; 
                        }
                        
                       // print_r($preInsure);die;
                        $preInsure['isExp'] = ($isExp)?"Expired":"Not Expired";
                       // $preInsure['expDate'] =  Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('d-m-Y');
                        $preInsure['policyNo'] = $response->result->vehicleInsurancePolicyNumber;
                        $address['addressLineOne'] = "";
                        $address['addressLineTwo'] = "";
                        if(isset($response->result->splitPresentAddress->addressLine)){
                            
                            $adrsLine = explode(',', $response->result->splitPresentAddress->addressLine, 2);
                            $address['addressLineOne'] = isset($adrsLine[0])?$adrsLine[0]:"";
                            $address['addressLineTwo'] = isset($adrsLine[1])?$adrsLine[1]:"";
                        }
                            
                        
                        //$address['addressLine'] =$response->result->splitPresentAddress->addressLine;
                        $address['pincode']=$response->result->splitPresentAddress->pincode;
                        $customer =  explode(' ',$response->result->owner);
                        $data = ['vehicleNumber'=>$response->result->regNo,
                                 'varient'=>['id'=>$Varient->id,'name'=>$Varient->variant],
                                 'model'=>['id'=>$Varient->modal_id,'name'=>$Varient->modal],
                                 'brand'=>['id'=>$Varient->make_id,'name'=>$Varient->make],
                                 'engine'=>$response->result->engine,'chassis'=>$response->result->chassis,
                                 'fueltype'=>$Varient->fuel_type,
                                 'cc'=>$Varient->cubic_capacity,
                                 'address'=>$address,
                                 'regDMY'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('d-m-Y'),
                                 'regDate'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('d'),
                                 'regMonth'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('m'),
                                 'regYear'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('Y'),
                                 'customer'=>['first_name'=>isset($customer[0])?$customer[0]:"",'last_name'=>isset($customer[1])?$customer[1]:""],
                                 'previousInsurance'=>$preInsure,
                                 'rcFinancer'=>$response->result->rcFinancer
                                 ];
                        return response()->json(['status' => true, 'message' =>'Data fetch successfully','data'=>$data]);
                }else{ // if model is not found
                     return response()->json(['status' => false, 'message' =>'Data Not found','data'=>""]);
                }
            }else{
                    
                 $response = $this->Signzy->GetVehicleDetails($request->vehicleNumber);
               //  print_r($response);
                 if(isset($response->id)){
                      
                         $insert =  ['regNo'=>$response->result->regNo, 'class'=>$response->result->class, 'chassis'=>$response->result->chassis, 'engine'=>$response->result->engine, 'vehicleManufacturerName'=>$response->result->vehicleManufacturerName, 
                                 'model'=>$response->result->model, 'vehicleColour'=>$response->result->vehicleColour, 'type'=>$response->result->type, 'normsType'=>$response->result->normsType, 'bodyType'=>$response->result->bodyType, 
                                 'ownerCount'=>$response->result->ownerCount, 'owner'=>$response->result->owner, 'ownerFatherName'=>$response->result->ownerFatherName, 'mobileNumber'=>$response->result->mobileNumber, 
                                 'status'=>$response->result->status, 'statusAsOn'=>$response->result->statusAsOn, 'regAuthority'=>$response->result->regAuthority, 'regDate'=>$response->result->regDate, 
                                 'vehicleManufacturingMonthYear'=>$response->result->vehicleManufacturingMonthYear, 'rcExpiryDate'=>$response->result->rcExpiryDate, 'vehicleTaxUpto'=>$response->result->vehicleTaxUpto, 
                                 'vehicleInsuranceCompanyName'=>$response->result->vehicleInsuranceCompanyName, 'vehicleInsuranceUpto'=>$response->result->vehicleInsuranceUpto, 'vehicleInsurancePolicyNumber'=>$response->result->vehicleInsurancePolicyNumber, 
                                 'rcFinancer'=>$response->result->rcFinancer, 
                                 'district'=>isset($response->result->splitPresentAddress->district[0])?$response->result->splitPresentAddress->district[0]:"", 
                                 'state'=>isset($response->result->splitPresentAddress->state[0][0])?$response->result->splitPresentAddress->state[0][0]:"", 
                                 'city'=>isset($response->result->splitPresentAddress->city[0])?$response->result->splitPresentAddress->city[0]:"", 
                                 'pincode'=>$response->result->splitPresentAddress->pincode, 
                                 'addressLine'=>$response->result->splitPresentAddress->addressLine, 'vehicleCubicCapacity'=>$response->result->vehicleCubicCapacity, 'grossVehicleWeight'=>$response->result->grossVehicleWeight, 'unladenWeight'=>$response->result->unladenWeight,
                                 'vehicleCategory'=>$response->result->vehicleCategory, 'vehicleCylindersNo'=>$response->result->vehicleCylindersNo, 'vehicleSeatCapacity'=>$response->result->vehicleSeatCapacity, 'wheelbase'=>$response->result->wheelbase, 
                                 'puccNumber'=>$response->result->puccNumber, 'puccUpto'=>$response->result->puccUpto, 'isCommercial'=>$response->result->isCommercial, 'json_result'=>json_encode($response)];
                                 //print_r($insert);die;
                               DB::table('vehicles_rc')->insert($insert);
                       //  print_r($insert);die;
             
                        $cc = (int)$response->result->vehicleCubicCapacity;
                        $fuel =  $response->result->type;
                        if(str_contains($fuel, '/')) { 
                           $F =  explode('/',$fuel);
                           $fuel = $F[0];
                        }
                       // $_searchStr = $response->result->model." ".$cc." ".$fuel;//"MARUTI SWIFT DZIRE VXI";
                       // $Varient = VarientCar::search($_searchStr)->first();
                        
                               if(str_contains($response->result->model, 'MARUTI')) { 
                                     $_searchStr = str_replace(strtoupper("MARUTI"),"",strtoupper($response->result->model));
                                }else if(str_contains($response->result->model, 'TATA')) { 
                                    $_searchStr = str_replace(strtoupper("TATA"),"",strtoupper($response->result->model));
                                }else{
                                     $_searchStr = strtoupper($response->result->model);//." ".$cc." ".$fuel;
                                }
                               
                            if($request->type=="TW"){
                                 $Varient = VarientTw::search($_searchStr,null, true)
                                                      ->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                                      ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                                       ->first();
                             }else{
                                 $Varient = VarientCar::search($_searchStr,null, true)
                                                      ->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                                      ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                                      ->first();
                             }
                       if(isset($Varient->id)){
                               // print_r(($Varient));
                               
                               
                               // Get pincode Info
                                $pin =  DB::table('pincode_masters')->select('state_id','city_id')->where('pincode',$response->result->splitPresentAddress->pincode)->first();
                                $address = [];
                               if(isset($pin->city_id)){
                                       $city = DB::table('cities')->where('id',$pin->city_id)->first(); 
                                       $address['city'] =isset($city->id)?$city->id."-".$city->name:"";
                                   
                                       $state  = DB::table('states')->where('id',$city->state_id)->first();
                                       $address['state'] = $state->id."-".$state->name; 
                                       
                               }
                                
                                if($response->result->vehicleInsuranceUpto!="NA" && $response->result->vehicleInsuranceUpto!=""){
                                            $isExp = Carbon::createFromFormat('d/m/Y', $response->result->vehicleInsuranceUpto)->isPast();
                                            if($isExp){
                                                $TODAY = Carbon::now();
                                                $_startDate = $TODAY->format('Y-m-d');     
                                                $_endDate = Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('Y-m-d');
                                                
                                                
                                                 $endDate=Carbon::parse($_endDate);
                                                 $startDate=Carbon::parse($_startDate);
                                                 
                                                  $diff = $endDate->diffInDays($startDate);
                                                  if($diff<=45){
                                                      $preInsure['exp'] ="-45";
                                                  }else if($diff>45 && $diff<=90){
                                                      $preInsure['exp'] ="45-90";
                                                  }else if($diff>90){
                                                      $preInsure['exp'] ="+90";
                                                  }else{
                                                      $preInsure['exp'] ="0";
                                                  }
                                                 
                                            }else{
                                                 $TODAY = Carbon::now();
                                                 $_endDate = $TODAY->format('Y-m-d');
                                                 $_startDate = Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('Y-m-d');
                                                
                                                 $endDate=Carbon::parse($_endDate);
                                                 $startDate=Carbon::parse($_startDate);
                                                 
                                                 $diff = $endDate->diffInDays($startDate);
                                                 $preInsure['exp'] ="";
                                              }
                                      $preInsure['expDate'] =  Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('d-m-Y');
                                }else{
                                    $isExp =  true;
                                }
                               
                                 if($response->result->vehicleInsuranceCompanyName!="NA"){
                                     $pre = explode(' ',$response->result->vehicleInsuranceCompanyName)[0];
                                     $PreSQL = DB::table('previous_insurer')->where('name','like',$pre."%");
                                     if($PreSQL->count()){
                                         $PREINS =  $PreSQL->first();
                                         $preInsure['insurer'] =  $PREINS->id;
                                    }else{
                                        $preInsure['insurer'] = ""; 
                                    }
                                }else{
                                   $preInsure['insurer'] = ""; 
                                }
                               // $preInsure['expDate'] =  Carbon::CreateFromFormat('d/m/Y',$response->result->vehicleInsuranceUpto)->format('d-m-Y');
                                $preInsure['policyNo'] = $response->result->vehicleInsurancePolicyNumber;
                                
                                $address['addressLine'] =$response->result->splitPresentAddress->addressLine;
                                $address['pincode']=$response->result->splitPresentAddress->pincode;
                                $customer =  explode(' ',$response->result->owner);
                                $data = ['vehicleNumber'=>$response->result->regNo,
                                         'varient'=>['id'=>$Varient->id,'name'=>$Varient->variant],
                                         'model'=>['id'=>$Varient->modal_id,'name'=>$Varient->modal],
                                         'brand'=>['id'=>$Varient->make_id,'name'=>$Varient->make],
                                         'engine'=>$response->result->engine,'chassis'=>$response->result->chassis,
                                         'fueltype'=>$Varient->fuel_type,
                                         'cc'=>$Varient->cubic_capacity,
                                         'address'=>$address,
                                         'regDMY'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('d-m-Y'),
                                         'regDate'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('d'),
                                         'regMonth'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('m'),
                                         'regYear'=>Carbon::CreateFromFormat('d/m/Y',$response->result->regDate)->format('Y'),
                                         'customer'=>['first_name'=>isset($customer[0])?$customer[0]:"",'last_name'=>isset($customer[1])?$customer[1]:""],
                                         'previousInsurance'=>$preInsure,
                                         'rcFinancer'=>$response->result->rcFinancer
                                         ];
                                return response()->json(['status' => true, 'message' =>'Data fetch successfully','data'=>$data]);
                                       
                       }else{ // if model is not found
                             return response()->json(['status' => false, 'message' =>'Data Not found','data'=>""]);
                        }            
                  }else{ // else api response is false
                     return response()->json(['status' => false, 'message' =>"Not found"]);
                  }
                        
            }//else get data from signzy
    }
    
      
    function loadidvModal(Request $request){
         $SQL = DB::table('app_temp_quote')
                     ->select('idv','min_idv','max_idv','provider')
                     ->where(['device'=>Auth::guard('customers')->user()->uniqueToken,'type'=>$request->type])->orderBy('id','DESC');
             if(strtolower($request->type)=='car'){
                 $SQL->limit(2);
             }else{
                 $SQL->limit(3);
             }        
         $data =  $SQL->get();
         $MIN=0;$MAX = 0;
         foreach($data as $dt){
               if($MIN==0){$MIN =   $dt->min_idv;}
                 else if($dt->min_idv<$MIN){ $MIN =  intval($dt->min_idv);}
                 
                if($MAX==0){$MAX =  intval($dt->max_idv);}  
                else if($dt->max_idv>$MAX){ $MAX =  intval($dt->max_idv);}
         }
          //$data = DB::table('app_temp_quote')->select('idv','min_idv','max_idv','provider')->where(['device'=>Auth::guard('customers')->user()->uniqueToken,'type'=>$request->type])->orderBy('id', 'DESC')->get();
         
         $D =  new \stdClass();
         $D->minval = $MIN; 
         $D->maxval = $MAX;
         $temp['typ'] = $request->type;
         $temp['idv'] = $D;//['min'=> $data->minval,'max'=>$data->maxval];
         return View::make('motor.idv_modal')->with($temp);
    }
    
    function load_TP_details_Modal(Request $request){
        $temp['previous_insurer'] = DB::table('previous_insurer')->where(['status'=>'ACTIVE','type'=>'GENERAL'])->get();
        $temp['type'] = $request->type;
        $temp['preCover'] =  isset($request->preCover)?$request->preCover:'COM';
        $temp['vTyp'] =  isset($request->vTyp)?$request->vTyp:'';
        return View::make('motor.moter_tp_details')->with($temp);
    }
    
    function moterPremiumBreakupModal(Request $request){
         $refId =  $request->refId;
         $typ   =  $request->typ;
         if($typ=='quote'){
             $info =   DB::table('app_temp_quote')->where('quote_id',$refId)->first();
             $temp['info'] =$info; 
             $temp['data']  = json_decode($info->json_data);
         }else{
             $info =   DB::table('app_quote')->where('enquiry_id',$refId)->first();
             $temp['info'] =$info;
             $temp['data']  = json_decode($info->json_data);
         }
         return View::make('motor.moter_premium_breakup')->with($temp);
    }
    
    
    public function getminMaxassValue(Request $request){
        $token = isset(Auth::guard('agents')->user()->posp_ID)?Auth::guard('agents')->user()->posp_ID:Auth::guard('customers')->user()->uniqueToken;
        $data = DB::table('app_temp_quote')
                     ->select('*')
                     ->where(['device'=>$token,'type'=>strtoupper($request->type),'provider'=>'DIGIT'])->orderBy('id','DESC')->first();
       // $json = json_decode($data->json_data);
       $resp = [];
           // print_r($data);
            $json = json_decode($data->json_recalculate);
            foreach($json->contract->coverages as $cover){ 
                if($cover->coverCode=="OWN_DAMAGE"){ 
                         foreach($cover->subCovers as $sub_od){ 
                              if($sub_od->componentNumber=="10134"){ //"CNG Kit - IMT 25"
                                  
                                  $resp['cng']['min'] = $sub_od->value->minValue;
                                  $resp['cng']['max'] = $sub_od->value->maxValue;
                              }
                              if($sub_od->componentNumber=="10132"){ //"Electrical Accessories - IMT 24"
                                   $resp['electrical']['min']  = $sub_od->value->minValue;
                                   $resp['electrical']['max']  = $sub_od->value->maxValue;
                                 //  print_r($sub_od->value->minValue);
                              }
                              if($sub_od->componentNumber=="10133"){ //"Non Electrical Accessories - IMT 24"
                                  $resp['nonelectrical']['min']  = $sub_od->value->minValue;
                                  $resp['nonelectrical']['max']  = $sub_od->value->maxValue;
                               }
                         }
                }
            }
          
       
             return response()->json($resp);
    }
    
    public function GetMake(Request $request){
         if(strtolower($request->param)=='car'){
             $results = DB::table('vehicle_make_car')->select(DB::raw("id,make as value"))->get();
             return response()->json(['status'=>true,'message'=>'Data get successfully','data'=>$results]);
         }else{
             $results = DB::table('vehicle_make_tw')->select(DB::raw("id,make as value"))->get();
             return response()->json(['status'=>true,'message'=>'Data get successfully','data'=>$results]);
         }
     }
     
    public function GetModelVarientByMake(Request $request){
        if(strtolower($request->param)=='car'){
            $results = DB::table('vehicle_variant_car')
                      ->select(DB::raw("CONCAT(vehicle_variant_car.id,'-',vehicle_variant_car.modal_id) as id,CONCAT(vehicle_modal_car.modal,' - ',vehicle_variant_car.variant,'(',vehicle_variant_car.cubic_capacity,'cc)') as value"))
                     ->leftJoin('vehicle_modal_car',"vehicle_modal_car.id", "=", "vehicle_variant_car.modal_id")
                     ->where('vehicle_modal_car.make_id',$request->make)->get();
           return response()->json(['status'=>true,'message'=>'Data get successfully','data'=>$results]);
         }else{
             $results = DB::table('vehicle_variant_tw')
                      ->select(DB::raw("CONCAT(vehicle_variant_tw.id,'-',vehicle_variant_tw.modal_id) as id,CONCAT(vehicle_modal_tw.modal,' - ',vehicle_variant_tw.variant,'(',vehicle_variant_tw.cubic_capacity,'cc)') as value"))
                     ->leftJoin('vehicle_modal_tw',"vehicle_modal_tw.id", "=", "vehicle_variant_tw.modal_id")
                     ->where('vehicle_modal_tw.make_id',$request->make)->get();
           return response()->json(['status'=>true,'message'=>'Data get successfully','data'=>$results]);
         }
    }
    
    public function getModelByMake(Request $request){
        $M = explode('-',$request->make);
        $tableName = ($request->type=='car')?'vehicle_modal_car':'vehicle_modal_tw';
        $models   = DB::table($tableName)->select(DB::raw("CONCAT(id,'-',modal) AS id,modal as value"))->where(['make_id'=>$M[0],'status'=>'ACTIVE'])->orderBy('modal','ASC')->get();
        return response()->json(['status'=>true,'message'=>'data get successfully','data'=>$models]);
    }
    
    public function getVarientByModel(Request $request){
        $M = explode('-',$request->model);
          $tableName = ($request->type=='car')?'vehicle_variant_car':'vehicle_variant_tw';
        $v  = DB::table($tableName)->select(DB::raw("CONCAT(id,'@',variant,'@',fuel_type,'@',cubic_capacity) AS id,CONCAT(variant,'-',fuel_type,'-',cubic_capacity,'cc') as value"))->where(['modal_id'=>$M[0]])->orderBy('variant','ASC')->get();
        return response()->json(['status'=>true,'message'=>'data get successfully','data'=>$v ]);
    }
   
    public function sendPaymentLink(Request $request){
       if($request->enquiryID){
            $SQL = DB::table('app_quote')->where('enquiry_id',$request->enquiryID);
            if($SQL->count()){
                      $enQ = $SQL->first();
                      if($enQ->status=="SOLD"){
                          $result  =['status'=>false,'message'=>"Policy for these enquiry already sold.",'data'=>''];
                       }else{
                          
                              $paramReQ = json_decode($enQ->params_request);
                              $jsonData = json_decode($enQ->json_data);
                              
                              $addons = "";
                              if(isset($jsonData->covers->addons)){
                                  foreach($jsonData->covers->addons as $adon){
                                      $addons = ($addons!="")?$addons.",".$adon->title:$adon->title;
                                  }
                              }
                              
                               
                               $partner = DB::table('our_partners')->where('shortName',$enQ->provider)->first();
                               
                               $encrypted = Crypt::encryptString($enQ->id);
                               $data['url'] = url('motor/'.strtolower($enQ->type)."-insurance/policy/payments/".$request->enquiryID."?utm_target=".$encrypted);
                               $data['enQ'] = $enQ;
                               $data['idv'] = setMoneyFormat($enQ->idv);
                               $data['ncb'] = isset($jsonData->vehicle->newNCB)?$jsonData->vehicle->newNCB:0;
                               $data['addons'] = !empty($addons)?$addons:"NA";
                               $data['partnerLogo'] = asset('assets/partners/'.$partner->logo_image);
                               $data['bannerImage'] = asset('site_assets/'.strtolower($enQ->type).'-email-banner.png');
                               $data['sfLogo'] = asset('site_assets/logo/'.config('custom.site_logo'));
                               $data['amount'] =  isset($jsonData->gross)?setMoneyFormat($jsonData->gross):'';
                               $data['vehicleInfo'] = $paramReQ->vehicle->brand->name." ".$paramReQ->vehicle->model->name." ".$paramReQ->vehicle->varient->name."-".$paramReQ->vehicle->fueltype."(".$paramReQ->vehicle->cc.")";
                               $data['customerName'] = $paramReQ->customer->first_name;
                               $custname = $paramReQ->customer->first_name." ".$paramReQ->customer->last_name;
                               $custemail=$paramReQ->customer->email;
                               $subject = "Payment link for your ". $paramReQ->vehicle->brand->name." ".$paramReQ->vehicle->model->name." ".$paramReQ->vehicle->varient->name;
                                Mail::send('insurance.email-template.moter-payment-link', $data, function($message) use ($custname, $custemail,$subject) {
                                  $message->to($custemail, $custname)
                                  ->subject($subject);
                                 $message->from('care@superfinserv.com',config('custom.site_short_name'));
                                });
                           return response()->json(['status'=>true,'message'=>'Payment link has been sent to `'.$custemail.'`']);
                    }
            }else{
                return response()->json(['status'=>false,'message'=>"Invalid Enquiry Found. Kindly contact to SuperFinserv's Relationship Manager"]);
                 
            }
       }else{
           return response()->json(['status'=>false,'message'=>'Something went wrong']);
       }
   }
  
    public function paymentLinkPage(Request $request){
              
            
         $enQId = $request->enQId;
         $template = ['title' => 'Motor Insurance',"subtitle"=>"Payment Link",'scripts'=>[asset('js/motor/motor-pay.js')]]; 
         $template['info'] =   DB::table('app_quote')->where('enquiry_id',$enQId)->first();
         $template['partner']  = DB::table('our_partners')->where('shortName',$template['info']->provider)->first();
         if($template['info']->provider=='HDFCERGO'){
              $txid = $template['info']->token;
              
              if($template['info']->type=="BIKE"){
                  $hashSequence = config('motor.HDFCERGO.tw.mKey')."|".$txid."|".config('motor.HDFCERGO.tw.secretToken')."|S001";
                  $template['paymetAction'] = config('motor.HDFCERGO.tw.paymentGateway');
              }else{
                  $hashSequence = config('motor.HDFCERGO.car.mKey')."|".$txid."|".config('motor.HDFCERGO.car.secretToken')."|S001";
                  $template['paymetAction'] = config('motor.HDFCERGO.car.paymentGateway');
              }
              $template['checkSum'] = strtoupper(hash('sha512', $hashSequence));
         }else if($template['info']->provider=='FGI'){
               $jsonData = json_decode($template['info']->json_data);
               $paramData = json_decode($template['info']->params_request);
               $template['TransactionID']= $template['info']->token;
               $template['PaymentOption']= 3;
               $template['ResponseURL'] = config('custom.site_url').'/moter-insurance/insured-success/bike/'.$enQId;
               $template['ProposalNumber'] =$enQId;
               $template['PremiumAmount']  = $jsonData->gross;
               $template['UserIdentifier'] = $paramData->customer->first_name." ".$paramData->customer->last_name;
               $template['UserId'] = $paramData->customer->mobile;
               $template['FirstName'] =$paramData->customer->first_name;
               $template['LastName'] = $paramData->customer->last_name;
               $template['Mobile'] =$paramData->customer->mobile;
               $template['Email'] =$paramData->customer->email;
               $template['Vendor'] =1;
               $hashSequence=$template['info']->token."|".$template['PaymentOption']."|".$template['ResponseURL']."|".$enQId."|".$jsonData->gross."|".$template['UserIdentifier']."|".$template['UserId']."|".$template['FirstName']."|".$template['LastName']."|".$template['Mobile']."|".$template['Email']."|";
               $template['checkSum'] = $this->FgiTw->Generatehash256($hashSequence);
               $template['paymetAction'] = config('motor.FGI.tw.payment');
         }
         return View::make('motor.payment-link-page')->with($template);
        
    }
    

   

    
}

