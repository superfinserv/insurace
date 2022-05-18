<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use App\Model\Agents;
use Auth;
use PDF;
use File;
use Response;
use Session;


class TaxInvoice {
    
      public function __construct(){}
    
     function GenerateInvoicePdf($agentID){
            $user = DB::table('agents')->where('id',$agentID)->first();
            $pay = DB::table('agent_payments')->where('agent_id', $agentID)->first();
            $filename = "Invoice-".$pay->invoice_no.".pdf";
        
            $logo = get_site_settings('site_logo');//"https://insurance.supersolutions.in/logo/logo_5.png";
            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data = base64_encode($avatarData);
            $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
            
            
            //SIGN
            $sign = public_path('site_assets/logo/tax-sign.png');//"https://insurance.supersolutions.in/logo/logo_5.png";
            $SarrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $Stype = pathinfo($sign, PATHINFO_EXTENSION);
            $SavatarData = file_get_contents($sign, false, stream_context_create($SarrContextOptions));
            $SavatarBase64Data = base64_encode($SavatarData);
            $data['sign'] = 'data:image/' . $Stype . ';base64,' . $SavatarBase64Data;
            
              $totalAmount = (float)$pay->total_amount;//intval((float)config('custom.posp_application_fee'));
              $totalActualPrice = number_format((float)(($totalAmount*100)/(118)), 2, '.', '');
              $tax1 = number_format((float)(($totalActualPrice*9)/100), 2, '.', '');//intval(($totalActualPrice*9)/100);
              $tax2 = number_format((float)(($totalActualPrice*9)/100), 2, '.', '');//intval(($totalActualPrice*9)/100);
              $tax = number_format((float)(($totalActualPrice*18)/100), 2, '.', '');//intval(($totalActualPrice*18)/100);
              //$total =  $fee_amount+$tax;
               
               if($user->state!="" && $user->state==25){
                   $cgst = ($tax1);//round(($fee_amount*9)/100);
                   $sgst = ($tax2);//round(($fee_amount*9)/100);
                   $data['cgst']='₹'.number_format((float)$cgst, 2, '.', '').'/-';
                   $data['sgst']='₹'.number_format((float)$sgst, 2, '.', '').'/-';
                   $data['igst']='₹00.00/-';
                   $data['total'] = '₹'.number_format((float)($totalAmount), 2, '.', '');
                   $data['payble'] = number_format((float)($totalAmount), 2, '.', '');
               }else{
                   $igst = ($tax);
                   $data['cgst']='₹00.00/-';
                   $data['sgst']='₹00.00/-';
                   $data['igst']='₹'.number_format((float)$igst, 2, '.', '').'/-';
                   $data['total'] = '₹'.number_format((float)($totalAmount), 2, '.', '');
                   $data['payble'] = number_format((float)($totalAmount), 2, '.', '');
               }
         $data['fee_payment'] = '₹'.number_format((float)($totalActualPrice), 2, '.', '');
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities')->where('id', $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states')->where('id', $user->state)->value('name'):"";
         $data['pay'] = $pay;
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('utils.pdf.pospFeeTaxInvoice',$data);
        
        // return $pdf->stream();
        // $headers =[
                //     'Content-Description' => 'File Transfer',
                //     'Content-Type' => 'application/pdf',
                // ];
         //$pdf->save('public/assets'.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        
       // return $pdf->download('public/assets'.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
       // return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        $pData = ['row'=>$pdf->output(),'name'=>$filename];
        return  $pData;
        
        // $data["body"]="";
        // Mail::send('templates.mail_freame', $data, function($message)use($data,$pdf) {
        //             $message->to('praveen.patidar10@gmail.com', "Praveen Patidar")
        //             ->subject('Test Attach')
        //             ->attachData($pdf->output(), "invoice.pdf");
        //             $message->from("care@supersolutions.in",'Supersolutions');
        //             });
        
    }
    
     function DownloadInvoicePdf($agentID){
            $user = DB::table('agents')->where('id',$agentID)->first();
            $pay = DB::table('agent_payments')->where('agent_id', $agentID)->first();
           // $filename = "Invoice-".str_replace("/","",$user->posp_ID).".pdf";
            $filename = "Invoice-".$pay->invoice_no.".pdf";
            
       
            $logo = get_site_settings('site_logo');//"https://insurance.supersolutions.in/logo/logo_5.png";
            $arrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type = pathinfo($logo, PATHINFO_EXTENSION);
            $avatarData = file_get_contents($logo, false, stream_context_create($arrContextOptions));
            $avatarBase64Data = base64_encode($avatarData);
            $data['logo'] = 'data:image/' . $type . ';base64,' . $avatarBase64Data;
            
            //SIGN
            $sign = public_path('site_assets/logo/tax-sign.png');//"https://insurance.supersolutions.in/logo/logo_5.png";
            $SarrContextOptions=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $Stype = pathinfo($sign, PATHINFO_EXTENSION);
            $SavatarData = file_get_contents($sign, false, stream_context_create($SarrContextOptions));
            $SavatarBase64Data = base64_encode($SavatarData);
            $data['sign'] = 'data:image/' . $Stype . ';base64,' . $SavatarBase64Data;
            
            
            
              $totalAmount = (float)$pay->total_amount;//intval((float)config('custom.posp_application_fee'));
              $totalActualPrice = number_format((float)(($totalAmount*100)/(118)), 2, '.', '');
              $tax1 = number_format((float)(($totalActualPrice*9)/100), 2, '.', '');//intval(($totalActualPrice*9)/100);
              $tax2 = number_format((float)(($totalActualPrice*9)/100), 2, '.', '');//intval(($totalActualPrice*9)/100);
              $tax = number_format((float)(($totalActualPrice*18)/100), 2, '.', '');//intval(($totalActualPrice*18)/100);
              //$total =  $fee_amount+$tax;
               
               if($user->state!="" && $user->state==25){
                   $cgst = ($tax1);//round(($fee_amount*9)/100);
                   $sgst = ($tax2);//round(($fee_amount*9)/100);
                   $data['cgst']='₹'.number_format((float)$cgst, 2, '.', '').'/-';
                   $data['sgst']='₹'.number_format((float)$sgst, 2, '.', '').'/-';
                   $data['igst']='₹00.00/-';
                   $data['total'] = '₹'.number_format((float)($totalAmount), 2, '.', '');
                   $data['payble'] = number_format((float)($totalAmount), 2, '.', '');
               }else{
                   $igst = ($tax);
                   $data['cgst']='₹00.00/-';
                   $data['sgst']='₹00.00/-';
                   $data['igst']='₹'.number_format((float)$igst, 2, '.', '').'/-';
                   $data['total'] = '₹'.number_format((float)($totalAmount), 2, '.', '');
                   $data['payble'] = number_format((float)($totalAmount), 2, '.', '');
               }
         $data['fee_payment'] = '₹'.number_format((float)($totalActualPrice), 2, '.', '');
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities')->where('id', $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states')->where('id', $user->state)->value('name'):"";
         $data['pay'] = $pay;
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
          //$pdf =  PDF::loadView('utils.pdf.pospFeeTaxInvoice',$data);
          
        return  PDF::loadView('utils.pdf.pospFeeTaxInvoice',$data);
      
        //  $headers =[
        //             'Content-Description' => 'File Transfer',
        //             'Content-Type' => 'application/pdf',
        //           ];
        
        //  return $pdf->download($filename.'.pdf',$filename.'.pdf',$headers);
        
    }
}