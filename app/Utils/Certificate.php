<?php
namespace App\Utils;
use Illuminate\Support\Facades\DB;
use App\Model\Agents;
use Auth;
use PDF;
use File;
use Response;
use Session;


class Certificate {
    
      public function __construct(){}
    
      public function GeneratePdf($pospID,$id){
        $certification= DB::table('certification')->where('id', $id)->first();
        $data = ['certification'=>$certification];
        $user = Agents::find($certification->agent_id); 
        $filename = "Certificate-".str_replace("/","_",$pospID).uniqid();
        $path = "public/assets/agents/pdf/certificate";
        if(!File::exists($path)) {
            File::makeDirectory($path, $mode = 0755, true, true);
        } 
       
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
            
            $profile = "public/assets/agents/profile/".$user->profile;
            $arrContextOptions1=array(
                            "ssl"=>array(
                                "verify_peer"=>false,
                                "verify_peer_name"=>false,
                            ),
                        );
            $type1 = pathinfo($profile, PATHINFO_EXTENSION);
            $avatarData1 = file_get_contents($profile, false, stream_context_create($arrContextOptions1));
            $avatarBase64Data1 = base64_encode($avatarData1);
            $data['profile'] = 'data:image/' . $type1 . ';base64,' . $avatarBase64Data1;
         $data['user'] = $user;
         $data['user_city'] = ($user->city!="" && $user->city>0)?DB::table('cities')->where('id',  $user->city)->value('name'):"";
         $data['user_state'] = ($user->state!="" && $user->state>0)?DB::table('states')->where('id',  $user->state)->value('name'):"";
         
         PDF::setOptions(['defaultFont' => 'sans-serif','defaultMediaType'=>'all','isFontSubsettingEnabled'=>true]);
         $pdf = PDF::loadView('utils.pdf.certificate_format',$data);
       
      
         //return $pdf->stream();
         $headers =[
                    'Content-Description' => 'File Transfer',
                    'Content-Type' => 'application/pdf',
                ];
         $pdf->save($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
          DB::table('certification')
                        ->where('id', $id)
                        ->update(['file' => $filename.'.pdf']);
         //return $pdf->download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
        return Response::download($path.'/'.$filename.'.pdf',$filename.'.pdf',$headers);
    }
   
}