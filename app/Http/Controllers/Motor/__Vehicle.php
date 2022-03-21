<?php  
namespace App\Http\Controllers\Motor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use Meng\AsyncSoap\Guzzle\Factory;
use Carbon\Carbon;
use App\VarientCar;
use App\VarientTw;

class Vehicle extends Controller{ 
    
    
    
    function GetVehicleRegistrationDetails(Request $request){
             
           // echo json_encode($_request);die;
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
                 }else{
                 $Varient = VarientCar::search($_searchStr,null, true)
                                          ->whereRaw('UPPER(fuel_type) LIKE ? ',[trim(strtoupper($fuel)).'%'])
                                          ->whereRaw('UPPER(cubic_capacity) LIKE ? ',$cc.'%')
                                          
                 ->first();
                 //print_r($Varient);die;
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
            }else{
                    try{
                            $_request = new \stdClass(); 
                            $_request->task = "detailedSearch";
                            
                            $essentials =  new \stdClass(); 
                            $essentials->vehicleNumber = $request->vehicleNumber;
                            $_request->essentials = $essentials;
                        
                       $client = new Client([
                            'headers' => [ 'Content-Type' => 'application/json','Authorization'=>"NXFDvNFtkGiXvxZIe5SLQiUeFG38rDf227O1XeHKfARFK68a5PWXTGg7EjsO0aav"]
                        ]);
                        
                        $clientResp = $client->post('https://preproduction.signzy.tech/api/v2/patrons/621f6be1dfc52fe36b9aac76/vehicleregistrations',
                            ['body' => json_encode($_request)]
                        );
                        $result = $clientResp->getBody()->getContents();
                      // print_r($result);die;
                        $response =  json_decode($result);
                        
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
                                         'puccNumber'=>$response->result->puccNumber, 'puccUpto'=>$response->result->puccUpto, 'isCommercial'=>$response->result->isCommercial, 'json_result'=>$result];
                                         //print_r($insert);die;
                                       DB::table('vehicles_rc')->insert($insert);
                        
                     
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
                        }catch (ConnectException $e) {
                            $response = $e->getResponse();
                            $responseBodyAsString = $response->getBody()->getContents();
                            $jsonRes = json_decode($responseBodyAsString);
                             
                            return response()->json(['status' => false, 'message' => $jsonRes->error->message]);
                        }catch (RequestException $e) {
                            $response = $e->getResponse();
                            $responseBodyAsString = $response->getBody()->getContents();
                           
                            $jsonRes = json_decode($responseBodyAsString); 
                            return response()->json(['status' => false, 'message' => $jsonRes->error->message]);
                        }catch (ClientException $e) {
                            $response = $e->getResponse();
                            $responseBodyAsString = $response->getBody()->getContents();
                            $jsonRes = json_decode($responseBodyAsString);
                            return response()->json(['status' =>false, 'message' => $jsonRes->error->message]);
                        }
            }//else get data from signzy
    }
}
?>