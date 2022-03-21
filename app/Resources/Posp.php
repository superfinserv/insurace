<?php
namespace App\Resources;
use Illuminate\Support\Facades\DB;
use App\Model\Agents;
class Posp extends AppResource{ 
    
    public function __construct(){
        
    }
   
   
   public function profileCompleteData($id){
             
               $complete=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('name')
                                          ->whereNotNull('email')
                                          ->whereNotNull('mobile')
                                          ->whereNotNull('profile')
                                          ->whereNotNull('city')
                                          ->whereNotNull('pincode')
                                          ->whereNotNull('address')
                                          ->whereNotNull('state')
                                          ->whereNotNull('sex')
                                          ->whereNotNull('marital_status')
                                          ->whereNotNull('educational_qualification')
                                          ->whereNotNull('education_certificate')
                                          ->whereNotNull('bank_name')
                                          ->whereNotNull('account_holder_name')
                                          ->whereNotNull('account_number')
                                          ->whereNotNull('ifsc_code')
                                          ->whereNotNull('passbook_statement')
                                          ->whereNotNull('pan_card_number')
                                          ->whereNotNull('pan_card')
                                          ->whereNotNull('adhaar_card_number')
                                          ->whereNotNull('adhaar_card')
                                          ->whereNotNull('adhaar_card_back');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $pData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('name')
                                          ->whereNotNull('email')
                                          ->whereNotNull('mobile')
                                          ->whereNotNull('profile')
                                          ->whereNotNull('city')
                                          ->whereNotNull('pincode')
                                          ->whereNotNull('address')
                                          ->whereNotNull('state')
                                          ->whereNotNull('sex')
                                          ->whereNotNull('marital_status');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $eData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('educational_qualification')
                                          ->whereNotNull('education_certificate');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $bData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('bank_name')
                                          ->whereNotNull('account_holder_name')
                                          ->whereNotNull('account_number')
                                          ->whereNotNull('ifsc_code')
                                          ->whereNotNull('passbook_statement');
                                          
                                })->where('id', $id)
                            ->count();
                            
                $dData=Agents::select('*')->where(function ($query) {
                                    $query->whereNotNull('pan_card_number')
                                          ->whereNotNull('pan_card')
                                          ->whereNotNull('adhaar_card_number')
                                          ->whereNotNull('adhaar_card')
                                          ->whereNotNull('adhaar_card_back');
                                          
                                })->where('id', $id)
                            ->count();
                            
             $rowdata=Agents::find($id);
             
             $maximumPoints = 100;
             $point_p = 0;$point_b = 0;$point_d = 0;$point_e = 0;$point = 0;
             $pInfo = 10; $bankInfo=20; $docInfo = 20;$eduInfo =50;$each=4.5454545455;
             
             $point += ($rowdata->name!=NULL && $rowdata->name!="")?$each:0;
             $point += ($rowdata->email!=NULL && $rowdata->email!="")?$each:0;
             $point += ($rowdata->mobile!=NULL && $rowdata->mobile!="")?$each:0;
             $point += ($rowdata->profile!=NULL && $rowdata->profile!="")?$each:0;
             $point += ($rowdata->city!=NULL && $rowdata->city!="")?$each:0;
             $point += ($rowdata->pincode!=NULL && $rowdata->pincode!="")?$each:0;
             $point += ($rowdata->address!=NULL && $rowdata->address!="")?$each:0;
             $point += ($rowdata->state!=NULL && $rowdata->state!="")?$each:0;
             $point += ($rowdata->sex!=NULL && $rowdata->sex!="")?$each:0;
             $point += ($rowdata->marital_status!=NULL && $rowdata->marital_status!="")?$each:0;
             
             $point += ($rowdata->bank_name!=NULL && $rowdata->bank_name!="")?$each:0;
             $point += ($rowdata->account_holder_name!=NULL && $rowdata->account_holder_name!="")?$each:0;
             $point += ($rowdata->account_number!=NULL && $rowdata->account_number!="")?$each:0;
             $point += ($rowdata->ifsc_code!=NULL && $rowdata->ifsc_code!="")?$each:0;
             $point += ($rowdata->passbook_statement!=NULL && $rowdata->passbook_statement!="")?$each:0;
             
             $point += ($rowdata->pan_card_number!=NULL && $rowdata->pan_card_number!="")?$each:0;
             $point += ($rowdata->pan_card!=NULL && $rowdata->pan_card!="")?$each:0;
             $point += ($rowdata->adhaar_card_number!=NULL && $rowdata->adhaar_card_number!="")?$each:0;
             $point += ($rowdata->adhaar_card!=NULL && $rowdata->adhaar_card!="")?$each:0;
             $point += ($rowdata->adhaar_card_back!=NULL && $rowdata->adhaar_card_back!="")?$each:0;
             
             $point += ($rowdata->educational_qualification!=NULL && $rowdata->educational_qualification!="")?$each:0;
             $point += ($rowdata->education_certificate!=NULL && $rowdata->education_certificate!="")?$each:0;
            
             $point_p += ($rowdata->name!=NULL && $rowdata->name!="")?$pInfo:0;
             $point_p += ($rowdata->email!=NULL && $rowdata->email!="")?$pInfo:0;
             $point_p += ($rowdata->mobile!=NULL && $rowdata->mobile!="")?$pInfo:0;
             $point_p += ($rowdata->profile!=NULL && $rowdata->profile!="")?$pInfo:0;
             $point_p += ($rowdata->city!=NULL && $rowdata->city!="")?$pInfo:0;
             $point_p += ($rowdata->pincode!=NULL && $rowdata->pincode!="")?$pInfo:0;
             $point_p += ($rowdata->address!=NULL && $rowdata->address!="")?$pInfo:0;
             $point_p += ($rowdata->state!=NULL && $rowdata->state!="")?$pInfo:0;
             $point_p += ($rowdata->sex!=NULL && $rowdata->sex!="")?$pInfo:0;
             $point_p += ($rowdata->marital_status!=NULL && $rowdata->marital_status!="")?$pInfo:0;
             
             $point_b += ($rowdata->bank_name!=NULL && $rowdata->bank_name!="")?$bankInfo:0;
             $point_b += ($rowdata->account_holder_name!=NULL && $rowdata->account_holder_name!="")?$bankInfo:0;
             $point_b += ($rowdata->account_number!=NULL && $rowdata->account_number!="")?$bankInfo:0;
             $point_b += ($rowdata->ifsc_code!=NULL && $rowdata->ifsc_code!="")?$bankInfo:0;
             $point_b += ($rowdata->passbook_statement!=NULL && $rowdata->passbook_statement!="")?$bankInfo:0;
             
             $point_d += ($rowdata->pan_card_number!=NULL && $rowdata->pan_card_number!="")?$docInfo:0;
             $point_d += ($rowdata->pan_card!=NULL && $rowdata->pan_card!="")?$docInfo:0;
             $point_d += ($rowdata->adhaar_card_number!=NULL && $rowdata->adhaar_card_number!="")?$docInfo:0;
             $point_d += ($rowdata->adhaar_card!=NULL && $rowdata->adhaar_card!="")?$docInfo:0;
             $point_d += ($rowdata->adhaar_card_back!=NULL && $rowdata->adhaar_card_back!="")?$docInfo:0;
             
             $point_e += ($rowdata->educational_qualification!=NULL && $rowdata->educational_qualification!="")?$eduInfo:0;
             $point_e += ($rowdata->education_certificate!=NULL && $rowdata->education_certificate!="")?$eduInfo:0;
             
             $personal = round(($point_p*100)/100);
             $bank = round(($point_b*100)/100);
             $document = round(($point_d*100)/100);
             $education = round(($point_e*100)/100);
             
             $percentage = round(($point*100)/100);
             
             $arr = ['iscomplete'=>$complete,'complete'=>$percentage,'count'=>$complete,
                     "ispersonal"=>$pData,"personal"=>$personal,
                     'isbank'=>$bData,'bank'=>$bank,
                     'isdocument'=>$dData, 'document'=>$document,
                     "iseducation"=>$eData, "education"=>$education,
                     "payment_status"=>$rowdata->payment_status,"isProceedSign"=>$rowdata->isProceedSign,
                     "isVerified"=>$rowdata->isVerified
                     ];
             
               return $arr;
             
    }
   
    
}