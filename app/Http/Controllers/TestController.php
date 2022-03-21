<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Resources\ManipalResource;
use App\Resources\CareResource;
use App\Resources\FgiResource;
use App\Resources\DigitResource;
use App\Resources\FgiCarResource;
use App\Resources\DigitCarResource;

    
class TestController extends Controller{
    
    public function __construct(ManipalResource $ManipalResource,
                                CareResource $CareResource,
                                FgiResource $FgiResource,
                                DigitResource $DigitResource,
                                FgiCarResource $FgiCarResource,
                                DigitCarResource $DigitCarResource) { 
       $this->ManipalResource = $ManipalResource;
       $this->CareResource = $CareResource;
       $this->FgiResource = $FgiResource;
       $this->DigitResource = $DigitResource;
       
       $this->FgiCarResource = $FgiCarResource;
       $this->DigitCarResource = $DigitCarResource;
   }
   
   function testkit(){
       //echo "ghjgh";
        $query = DB::table('temp_vehicles_car')->whereBetween('id', [6001, 7000])->get();
        // foreach($query as $temp){
        //     $make  =  strtoupper($temp->make);
        //     $hasMake = DB::table("vehicle_make_car")->where('make',$make)->count();
        //     if($hasMake){
        //          $makeId = DB::table("vehicle_make_car")->where(DB::raw('UPPER(make)'),$make)->value('id');
        //     }else{
        //         $makeId = DB::table("vehicle_make_car")->insertGetId(['make'=>$make,'hdfcErgo_makeCode'=>$temp->hdfcErgoMake_id]);  
        //     }
           
        //   $hasModal = DB::table("vehicle_modal_car")->where('make_id',$makeId)->where('modal',$temp->modal)->count(); 
        //   if($hasModal){
        //       $modalId = DB::table("vehicle_modal_car")->where('make_id',$makeId)->where('modal',$temp->modal)->value('id');
        //   }else{
        //       $modalId = DB::table("vehicle_modal_car")->insertGetId(['modal'=>$temp->modal,'make_id'=>$makeId]); 
        //   }
           
        //   DB::table('temp_vehicles_car')->where('id',$temp->id)->update(['make_id'=>$makeId,'modal_id'=>$modalId]);
            
        // }
   }
    
//   function testkit(){
//         $query = DB::table('vehicle_variant')->whereBetween('id', [1, 100])->get();
//         foreach($query as $row){
//             print_r($row);
//             $hasMake = DB::table("vehicle_make")
//                           ->where(DB::raw('lower(make)'),strtolower($row->make))
//                           ->where(function ($query) {
//                             $query->where('vehicle_type','Pvt Car')
//                                   ->orWhere('vehicle_type','Trailer')
//                                   ->orWhere('vehicle_type','Miscellaneous')
//                                   ->orWhere('vehicle_type','Passenger Carrying');
//                             })->count();
                          
//                   if($hasMake){
//                       $makeId = DB::table("vehicle_make")
//                                   ->where(DB::raw('lower(make)'),strtolower($row->make))
//                                   ->where(function ($query) {
//                                     $query->where('vehicle_type','Pvt Car')
//                                           ->orWhere('vehicle_type','Trailer')
//                                           ->orWhere('vehicle_type','Miscellaneous')
//                                           ->orWhere('vehicle_type','Passenger Carrying');
//                                     })->value('id');
//                   }else{
//                      $makeId = DB::table("vehicle_make")->insertGetId(['make'=>trim($row->make),'vehicle_type'=>'Pvt Car,Trailer,Miscellaneous,Passenger Carrying']);  
//                   }
//             //if($row->vehicle_type=='Pvt Car' || $row->vehicle_type=='Goods Carrying' || 
//             //   $row->vehicle_type=='Miscellaneous' || $row->vehicle_type=="Passenger Carrying" || 
//             //   $row->vehicle_type=="Trailer"){
                  
                   
//             //   }else{
                   
//             //   }
//               //->whereRaw("find_in_set($row->vehicle_type,tags)")
                          
//             // $makeCount4w = DB::table('vehicle_make')->where('vehicle_type','Pvt Car')
//             //                                       ->orWhere('vehicle_type','Goods Carrying')
//             //                                       ->orWhere('vehicle_type','Miscellaneous')
//             //                                       ->orWhere('vehicle_type','Passenger Carrying')->count();
//             // if($makeCount4w){
                
//             // }else{
//             //   DB::table('vehicle_make')->insert() 
//             // }
            
            
//             echo "<br/><hr/><br/>";
//         }
//   }
    
    
    
   
}