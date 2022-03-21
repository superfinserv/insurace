<?php

namespace App\Http\Controllers\Pos;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Illuminate\Support\Facades\Hash;
use App\Model\Agents;
use PDF;
use Auth;
use App\Resources\Posp;
class ProfileController extends Controller{
     
     public function __construct(Posp $posp) { 
         $this->Posp = $posp; 
        //$this->middleware('auth');
       
       
   }
     
    /* Profile information handling request */
   
    public function index(){
        
        $id    = Auth::guard('agents')->user()->id;
        $template['data']  = $this->Posp->profileCompleteData($id);
        $template['states'] = DB::table('states_list')->get();
        $template['banks'] = DB::table('banklist')->get();
        $agent = Agents::select('*')->where('id', $id)->first();
        if($agent->state!=""){
          $template['cities']  = DB::table('cities_list')->where('state_id',$agent['state'])->get();
        }
        $template['agent'] = $agent;
        $count_bussness_info = DB::table('agent_bussness_info')->where('agent_id', $id)->count();
        if($count_bussness_info){
            $template['agent_bussness_info'] = DB::table('agent_bussness_info')->where('agent_id', $id)->first();
        }else{
            DB::table('agent_bussness_info')->insertGetId(['agent_id'=>$id]);
            $template['agent_bussness_info'] = DB::table('agent_bussness_info')->where('agent_id', $id)->first();
        }
        if($agent->mapped_sp!=""){
          $template['sp']  = DB::table('users')->where('id',$agent->mapped_sp)->first();
        }
        $template['title']= 'Become a POSP';
        $template["subtitle"]="Profile";
        $template['scripts']=[asset('page_js/pospJs/profile.js'),asset('page_js/pospJs/upload-profile.js')];
        return View::make('pos.profile.profile')->with($template);
          
    }
    
    public function updateSingleInfo(Request $request){
        $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
           
        if($count==0) {
            $agInfo = Agents::find($id);
            if($request->_typ=='file'){
                $avatarName="";
                    if($request->hasFile('education_certificate')){
                        $avatarName = 'Education-Certificate-'.$agInfo->id.'.'.request()->education_certificate->getClientOriginalExtension();
                        $request->education_certificate->move("public/assets/agents/education_certificate/", $avatarName);
                        $agInfo->education_certificate= $avatarName;
                    }else if($request->hasFile('passbook_statement')){
                        $avatarName = 'Passbook-'.$agInfo->id.'.'.request()->passbook_statement->getClientOriginalExtension();
                        $request->passbook_statement->move("public/assets/agents/passbook_statement/", $avatarName);
                        $agInfo->passbook_statement = $avatarName;
                    }else if($request->hasFile('pan_card')){
                        $avatarName = 'Pan-Card-'.$agInfo->id.'.'.request()->pan_card->getClientOriginalExtension();
                        $request->pan_card->move("public/assets/agents/pan_card/", $avatarName);
                        $agInfo->pan_card = $avatarName;
                    }else if($request->hasFile('adhaar_card')){
                       $avatarName = 'Adhar-Card-'.$agInfo->id.'.'.request()->adhaar_card->getClientOriginalExtension();
                       $request->adhaar_card->move("public/assets/agents/adhaar_card/", $avatarName);
                       $agInfo->adhaar_card = $avatarName;
                    }else if($request->hasFile('adhaar_card_back')){
                        
                       $avatarName = 'Adhar-Card-Back-'.$agInfo->id.'.'.request()->adhaar_card_back->getClientOriginalExtension();
                       $request->adhaar_card_back->move("public/assets/agents/adhaar_card/", $avatarName);
                       $agInfo->adhaar_card_back = $avatarName;
                    }
               
                if($agInfo->save()){ 
                    $com = $this->Posp->profileCompleteData($id);
                    return Response::json(['status'=>'success','name'=>$avatarName,'message'=>'Updated successfully','data'=>$com]);
                }else{
                     $com = $this->Posp->profileCompleteData($id);
                    return Response::json(['status'=>'error','name'=>'','message'=>'Error while update information','data'=>$com]);
                }
            }else{
                //$agInfo = Agents::find($id);
                
                if($request->ref=='business-section'){
                   $colName = ($request->name=='experience')?'exp':$request->name;
                    DB::table('agent_bussness_info')->where('agent_id',$id)->update([$colName=>$request->val]);
                     $com = $this->Posp->profileCompleteData($id);
                    
                    return Response::json(['status'=>'success','message'=>$request->name.' updated successfully','data'=>$com]);
                }else{
                    $agInfo->{$request->name}=$request->val;
                    if($agInfo->save()){ 
                       $com = $this->Posp->profileCompleteData($id);
                       return Response::json(['status'=>'success','message'=>$request->name.' updated successfully','data'=>$com]);
                    }else{
                         $com = $this->Posp->profileCompleteData($id);
                        return Response::json(['status'=>'error','message'=>'Error while update information','data'=>$com]);
                    }
                }
            }
        }else{
             $com = $this->Posp->profileCompleteData($id);
             return Response::json(['status'=>'error','message'=>'Your profile is complete, please contact your relationship manager to update any information','data'=>$com]);
        }
    }
    
     public function profileOverview(){
        $id    =Auth::guard('agents')->user()->id;
        $agent = Agents::select('*')->where('id', $id)->first();
        $template['agent'] = $agent;
        if($agent->mapped_sp!=""){
          $template['sp']  = DB::table('users')->where('id',$agent->mapped_sp)->first();
        }
        $template['title']= 'Super Finserv POSP';
        $template["subtitle"]="Profile Overview";
        $template['scripts']=[asset('site_assets/pospJs/profile.js')];
        return View::make('pos.profile.profile_overview')->with($template);
          
    }
    
    function checkIsExist(Request $request){
        if($request->type!=""){
             switch (strtoupper($request->type)) {
              case "PANCARD":
                  $isExist = Agents::select('*')->where('id','!=',Auth::guard('agents')->user()->id)->where('pan_card_number', $request->term)->count();
                  echo ($isExist)?'false':'true';
                break;
              case "EMAIL":
               $isExist = Agents::select('*')->where('email', $request->term)->count();
                  echo ($isExist)?'false':'true';
                break;
              case "MOBILE":
                  $isExist = Agents::select('*')->where('mobile', $request->term)->count();
                  echo ($isExist)?'false':'true';
                break;
             case "ACNUMBER":
                  $isExist = Agents::select('*')->where('id','!=',Auth::guard('agents')->user()->id)->where('account_number', $request->term)->count();
                  echo ($isExist)?'false':'true';
                break;
              case "AADHAR":
                $isExist = Agents::select('*')->where('adhaar_card_number', $request->term)->count();
                 echo ($isExist)?'false':'true';
                break;
              default:
                echo "Your favorite color is neither red, blue, nor green!";
            }
        }
    }
    
    
    public function getAlertNotification(Request $request){
        $id =Auth::guard('agents')->user()->id;
        $com = $this->Posp->profileCompleteData($id);
        return json_encode(['status'=>"success",'data'=>$com ]);
        
    }
    
    public function checkCount(){
         $id =Auth::guard('agents')->user()->id;
         $agent=Agents::select('isProceedSign')->where('id', $id)->first();
         return $agent->isProceedSign;
        
    }
    
    public function personalinfo(Request $request) {
        $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
        if($count==0) {
            $Cust = Agents::find($id);
             $Cust->name=$request->name;
             $Cust->city=$request->city;
            $Cust->state=$request->state;
             $Cust->sex=$request->sex;
             $Cust->address=$request->address;
             if($request->alternate_mobile){
                $Cust->alternate_mobile=$request->alternate_mobile;
             }
             $Cust->marital_status=$request->marital_status;
             $Cust->pincode=$request->pincode;
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Personal Information updated successfully',
                                     'data'=>['iscomplete'=>$com['iscomplete'],'ispersonal'=>$com['ispersonal'],'personal'=>$com['personal']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while updating Personal info",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'ispersonal'=>$com['ispersonal'],'personal'=>$com['personal']]
                                    ]);
             }
         }else{
            $com = $this->Posp->profileCompleteData($id);
            return json_encode(['statuse'=>"error",
                                 'msg'=>"Your Personal information completed .you can not update your Personal information !",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'ispersonal'=>$com['ispersonal'],'personal'=>$com['personal']]
                                 ]);
        }

    }
    
    public function bankinfo(Request $request){
        $avatarName=null;
        $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
        if($count==0) {
           
             $Cust = Agents::find($id);
             $Cust->bank_name=$request->bank_name;
             $Cust->ifsc_code=$request->ifsc_code;
             $Cust->account_number=$request->account_number;
             $Cust->account_holder_name=$request->account_holder_name;
             if($request->hasFile('passbook_statement')){
               $avatarName = uniqid().$Cust->id.'.'.request()->passbook_statement->getClientOriginalExtension();
               
                
                //$request->passbook_statement->move(public_path('agents/adhaar_card'), $avatarName);
                $request->passbook_statement->move("public/assets/agents/passbook_statement/", $avatarName);
        
                $Cust->passbook_statement = $avatarName;
              }else{
                if($Cust->passbook_statement){
                     $Cust->passbook_statement= $Cust->passbook_statement;
                }else{
                    $Cust->passbook_statement =null;
                }
                
              }
             
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Bank Information updated successfully',
                                     'name'=>$avatarName,
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isbank'=>$com['isbank'],'bank'=>$com['bank']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while updating bank info",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isbank'=>$com['isbank'],'bank'=>$com['bank']]
                                    ]);
             }
         }else{
            $com = $this->Posp->profileCompleteData($id);
            return json_encode(['statuse'=>"error",
                                 'msg'=>"Your Bank information completed .you can not update your bank information !",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'isbank'=>$com['isbank'],'bank'=>$com['bank']]
                                 ]);
        }

    }
    
    public function documentinfo(Request $request) {
        $count=$this->checkCount();
         $id =Auth::guard('agents')->user()->id;
        if($count==0) {
           
            $Cust = Agents::find($id);
            $adhaar_card=null;$pan_card=null;$adhaar_card_back=null;
            $Cust->adhaar_card_number=$request->adhaar_card_number;
            $Cust->pan_card_number=$request->pan_card_number;
            
            if($request->hasFile('adhaar_card')){
               $adhaar_card = uniqid().$Cust->id.'.'.request()->adhaar_card->getClientOriginalExtension();
               //$request->adhaar_card->move(public_path('agents/adhaar_card'), $adhaar_card);
               $request->adhaar_card->move("public/assets/agents/adhaar_card/", $adhaar_card);
               $Cust->adhaar_card = $adhaar_card;
            }else{
                if($Cust->adhaar_card){ $Cust->adhaar_card= $Cust->adhaar_card; }
                else{ $Cust->aadhar_card =null; $adhaar_card="";}
            }
            
            if($request->hasFile('pan_card')){
                $pan_card =uniqid().$Cust->id.'.'.request()->pan_card->getClientOriginalExtension();
                //$request->pan_card->move(public_path('agents/pan_card'), $pan_card);
                $request->pan_card->move("public/assets/agents/pan_card/", $pan_card);
                $Cust->pan_card = $pan_card;
            }else{
                 if($Cust->pan_card){ $Cust->pan_card= $Cust->pan_card;}
                 else{ $Cust->pan_card =null; $pan_card="";}
            }
            
            if($request->hasFile('adhaar_card_back')){
                 $adhaar_card_back = uniqid().$Cust->id.'.'.request()->adhaar_card_back->getClientOriginalExtension();
                 //$request->adhaar_card_back->move(public_path('agents/adhaar_card'), $adhaar_card_back);
                 $request->adhaar_card_back->move("public/assets/agents/adhaar_card/", $adhaar_card_back);
                 $Cust->adhaar_card_back = $adhaar_card_back;
            }else{
                if($Cust->adhaar_card_backs){ $Cust->adhaar_card_back= $Cust->adhaar_card_back;}
                else{ $Cust->adhaar_card_back =null; $adhaar_card_back="";}
                
            }
              
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Document Information updated successfully',
                                     'pan'=>$Cust->pan_card,
                                     'aadhar'=>$Cust->adhaar_card,
                                     'aadharback'=>$Cust->adhaar_card_back,
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while updating Document info",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
             }
             
         }else{
            $com = $this->Posp->profileCompleteData($id);
                 return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                 ]);
        }

    }
     
    public function educationinfo(Request $request) {
        $count=$this->checkCount();
         $id =Auth::guard('agents')->user()->id;
        if($count==0) {
           
             $avatarName=null;
             $Cust = Agents::find($id);
             $Cust->educational_qualification=$request->educational_qualification;
            if($request->hasFile('education_certificate')){
               $avatarName = uniqid().$Cust->id.'.'.request()->education_certificate->getClientOriginalExtension();
               
                //$request->education_certificate->move(public_path('agents/education_certificate'), $avatarName);
                 $request->education_certificate->move("public/assets/agents/education_certificate/", $avatarName);
                $Cust->education_certificate= $avatarName;
              }else{
                    if($Cust->education_certificate){
                         $Cust->education_certificate=$Cust->education_certificate;
                         $avatarName=$Cust->education_certificate;
                    }else{
                      $Cust->education_certificate=null;
                    }
              }
            
            if($Cust->save()){  
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Education detail is updated.',
                                     'name'=>$avatarName,
                                    'data'=>['iscomplete'=>$com['iscomplete'],'iseducation'=>$com['iseducation'],'education'=>$com['education']]
                                    ]);
            }else { 
                $com = $this->Posp->profileCompleteData($id);
               return json_encode(['status'=>"success",
                                     'msg'=>'Education certificate removed',
                                    'data'=>['iscomplete'=>$com['iscomplete'],'iseducation'=>$com['iseducation'],'education'=>$com['education']]
                                    ]);
             }
        }else{
            $com = $this->Posp->profileCompleteData($id);
               return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'iseducation'=>$com['iseducation'],'education'=>$com['education']]
               ]);
        }

    }
     
    public function businessinfo(Request $request) {
         $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
        if($count==0) {
            
                 $data['income'] =$request->income;
                 $data['exp'] =$request->experience;
                 $data['is_ins_bus'] =$request->is_ins_bus;
                 $data['motor_premium'] =$request->motor_premium;
                 $data['health_premium'] =$request->health_premium;
                 $data['life_premium'] =$request->life_premium;
            if($request->noneCheck==1){
                
                 $data['is_none'] =$request->noneCheck;
                 $data['is_agency_health'] =0;
                 $data['agency_health'] =NULL;
                 $data['is_agency_life'] =0;
                 $data['agency_life'] =NULL;
                 $data['is_agency_general'] =0;
                 $data['agency_general'] =0;
                 $data['is_pos_life'] =0;
                 $data['pos_life'] =NULL;
                 $data['is_pos_general'] =0;
                 $data['pos_general'] =NULL;
                 $data['is_surveyor'] =0;
                 $data['surveyor'] =NULL;

            }else{
                if($request->is_agency_health){
                     $data['is_agency_health'] =$request->is_agency_health;
                     $data['agency_health'] =$request->agency_health;
                }else{
                     $data['is_agency_health'] =0;
                     $data['agency_health'] =NULL;
                }
                if($request->is_agency_life){
                     $data['is_agency_life'] =$request->is_agency_life;
                     $data['agency_life'] =$request->agency_life;
                }else{
                     $data['is_agency_life'] =0;
                     $data['agency_life'] =NULL;
                }
                if($request->is_agency_gerenal){
                     $data['is_agency_general'] =$request->is_agency_gerenal;
                     $data['agency_general'] =$request->agency_gerenal;
                }else{
                     $data['is_agency_general'] =0;
                     $data['agency_general'] =NULL;
                }
                if($request->is_pos_life){
                     $data['is_pos_life'] =$request->is_pos_life;
                     $data['pos_life'] =$request->pos_life;
                }else{
                     $data['is_pos_life'] =0;
                     $data['pos_life'] =NULL;
                }
                if($request->is_pos_gerenal){
                     $data['is_pos_general'] =$request->is_pos_gerenal;
                     $data['pos_general'] =$request->pos_gerenal;
                }else{
                     $data['is_pos_general'] =0;
                     $data['pos_general'] =NULL;
                }
                if($request->is_surveyor){
                     $data['is_surveyor'] =$request->is_surveyor;
                     $data['surveyor'] =$request->surveyor;
                }else{
                     $data['is_surveyor'] =0;
                     $data['surveyor'] =NULL;
                }
                 $data['is_none'] =0;
            }
           
             $Cust= DB::table('agent_bussness_info')
            ->where('agent_id', $id)
            ->update($data);
            if($Cust)
            {  
                return json_encode(array('statusCode'=>200,'msg'=>'sucess'));
            } 
            else { 
                return json_encode(array('statusCode'=>400,'msg'=>"User details not updated"));
             }
         }else{
                return json_encode(array('statusCode'=>300,'msg'=>"Your profile is complete, please contact your relationship manager to update any information"));
        }

    }
     
    public function deletecertificate(Request $request) {
        $count=$this->checkCount();  $id =Auth::guard('agents')->user()->id;
        if($count==0) {
           
             $avatarName=null;
             $Cust = Agents::find($id);
             //$image_path = public_path().'/agents/education_certificate/'.$Cust->education_certificate;
             $image_path = public_path("assets/agents/education_certificate/".$Cust->education_certificate);
               if(File::exists($image_path)) {
                  File::delete($image_path);
               }
            $Cust->education_certificate=null;
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Education certificate removed',
                                    'data'=>['iscomplete'=>$com['iscomplete'],'iseducation'=>$com['iseducation'],'education'=>$com['education']]
                                    ]);
            }else { 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while remove certificate",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'iseducation'=>$com['iseducation'],'education'=>$com['education']]
                                    ]);
             }
        }else{
            $com = $this->Posp->profileCompleteData($id);
             return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'iseducation'=>$com['iseducation'],'education'=>$com['education']]
                                 ]);
        }


    }
     
    public function deletebankstatement(Request $request) {
         $count=$this->checkCount();
         $id =Auth::guard('agents')->user()->id;
         if($count==0) {
            
             $avatarName=null;
             $Cust = Agents::find($id);
            $image_path =  $image_path = public_path('assets/agents/passbook_statement/'.$Cust->passbook_statement);
            if(File::exists($image_path)) { File::delete($image_path); }
            $Cust->passbook_statement=null;
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Passbook statment copy removed!',
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isbank'=>$com['isbank'],'bank'=>$com['bank']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while remove statment copy",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isbank'=>$com['isbank'],'bank'=>$com['bank']]
                                    ]);
             }
         }else{
            $com = $this->Posp->profileCompleteData($id);
            return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'isbank'=>$com['isbank'],'bank'=>$com['bank']]
                                 ]);
        }


    }
     
    public function deletepan_card(Request $request) {
        $count=$this->checkCount();
         $id =Auth::guard('agents')->user()->id;
        if($count==0) {
            $avatarName=null;
            $Cust = Agents::find($id);
            $image_path = public_path('assets/agents/pan_card/'.$Cust->pan_card);
            if(File::exists($image_path)) { File::delete($image_path); }
             
            $Cust->pan_card=null;
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Pan card copy removed!',
                                     'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while remove Pan card copy",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
             }
         }else{
            $com = $this->Posp->profileCompleteData($id);
            return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                 ]);
        }


    }
     
    public function deleteadhaar_card(Request $request) {
        $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
        if($count==0) {
            $avatarName=null;
            $Cust = Agents::find($id);
            $image_path = public_path('assets/agents/adhaar_card/'.$Cust->adhaar_card);
            if(File::exists($image_path)) {File::delete($image_path);}
             
            $Cust->adhaar_card=null;
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Address proof copy removed!',
                                     'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while remove Address proof copy",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
             }
         }else{
            $com = $this->Posp->profileCompleteData($id);
            return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                 ]);
        }


    } 
    
    public function deleteadhaar_card_back(Request $request) {
        $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
        if($count==0) {
             $avatarName=null;
             $Cust = Agents::find($id);
             $image_path = public_path('assets/agents/adhaar_card/'.$Cust->adhaar_card_back);
             if(File::exists($image_path)) {  File::delete($image_path); }
             
             $Cust->adhaar_card_back=null;
            if($Cust->save()){ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"success",
                                     'msg'=>'Address proof copy removed!',
                                     'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
            }else{ 
                $com = $this->Posp->profileCompleteData($id);
                return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while remove Address proof copy",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                    ]);
             }
         }else{
            $com = $this->Posp->profileCompleteData($id);
            return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'isdocument'=>$com['isdocument'],'document'=>$com['document']]
                                 ]);
        }


    }
     
    public function updateprofile(Request $request) {
        $count=$this->checkCount();
        $id =Auth::guard('agents')->user()->id;
        if($count==0) {
            //print_r($_FILES);
            if(!empty($request->file('cropped_image'))) {
                 $Cust = Agents::find($id);
                 $oldfile = $Cust->profile;
                //  $fileName = uniqid(). $id.'.'.request()->cropped_image->getClientOriginalExtension();
                $fileName = uniqid(). $id.'.png';
                $request->cropped_image->move('public/assets/agents/profile/', $fileName);
                 $Cust->profile=$fileName;
                 if($Cust->save()){ 
                        if($oldfile!='' && $oldfile!="avatar.png"){
                            $image_path = public_path('assets/agents/profile/'.$oldfile);
                            if(file_exists($image_path)){ 
                              unlink((public_path('assets/agents/profile/') . $oldfile));
                          }
                 }
                 $com = $this->Posp->profileCompleteData($id);
                  return json_encode(['status'=>"success",
                                        'msg'=>'profile image update successfully',
                                        'url'=>asset('assets/agents/profile/'.$fileName),
                                        'data'=>['iscomplete'=>$com['iscomplete'],'ispersonal'=>$com['ispersonal'],'personal'=>$com['personal']]
                                        ]);
                }else { 
                      $com = $this->Posp->profileCompleteData($id);
                    return json_encode(['status'=>"error",
                                    'msg'=>"Internal error while updating profile image",
                                    'data'=>['iscomplete'=>$com['iscomplete'],'ispersonal'=>$com['ispersonal'],'personal'=>$com['personal']]
                                    ]);
                }
            }

    }else{
           $com = $this->Posp->profileCompleteData($id);
        return json_encode(['statuse'=>"error",
                                 'msg'=>"Your profile is complete, please contact your relationship manager to update any information",
                                 'data'=>['iscomplete'=>$com['iscomplete'],'ispersonal'=>$com['ispersonal'],'personal'=>$com['personal']]
                                 ]);
    }
    
   


    }
    
    
    /* Profile veify Handleing methods */
     
    public function recordingvideo(){

        $template = ['title' => 'profile',"subtitle"=>"profile",
                     'scripts'=>[asset('site_assets/pospJs/video_Recording.js')]];
      
        return View::make('profile.video_recording')->with($template);
      }
     
    public function storeUpload( Request $request ){
          $data = str_replace("data:audio/mp3;base64,","",$request->data);
          Storage::put('file.mp3', base64_decode($data), 'public');
        }
     
    public function profile_details(Request $request){
         $id =Auth::guard('agents')->user()->id;
         $agent_info = DB::table('agents')->select('agents.*','states_list.name as state_name','cities_list.name as city_name')
            ->leftJoin('states_list', 'states_list.id', '=', 'agents.state')
             ->leftJoin('cities_list', 'cities_list.id', '=', 'agents.city')
             ->where('agents.id',$id)
            ->first();
            if($agent_info->isProceedSign==1){ return redirect('/profile'); }
        $template = ['title' => 'profile',"subtitle"=>"profile",
                     'scripts'=>[asset('site_assets/pospJs/profile.js')],'agent_info'=>$agent_info];
      
        return View::make('pos.identity.profile_details')->with($template);
    }
     
    public function profile_video_uploads(Request $request){
        $id =Auth::guard('agents')->user()->id;
        $agent_info = DB::table('agents')->select('agents.*','states_list.name as state_name','cities_list.name as city_name')
            ->leftJoin('states_list', 'states_list.id', '=', 'agents.state')
             ->leftJoin('cities_list', 'cities_list.id', '=', 'agents.city')
             ->where('agents.id',$id)
            ->first();
        if($agent_info->isProceedSign==1){ return redirect('/profile'); }
        $template = ['title' => 'Profile',"subtitle"=>"Identity Verification",
                     'scripts'=>[asset('page_js/pospJs/profile.js')],'agent_info'=>$id];
      
        return View::make('pos.identity.profile_video_upload')->with($template);
    }
     
    public function profile_video_uploads_save(Request $request) {
            $id =Auth::guard('agents')->user()->id;
             if(!empty($request->file('identityVideo'))) {
                    $user = Agents::find($id);
                    $fileName = "video-".uniqid().$id.'.'.request()->identityVideo->getClientOriginalExtension();
                    $request->identityVideo->move('public/assets/agents/profile/', $fileName);
                      
                      $user->videoFile=$fileName;
                      $user->isProceedSign=1;
                       if($user->save()){ 
  
                           return json_encode(array('status'=>'success','msg'=>'sucess'));
                        } else { 
                           return json_encode(array('status'=>'error','msg'=>"User details not updated"));
                         }
        }

    }
}
