<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
//use Redirect;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use PDF;

use App\Resources\DigitCarResource;
use App\Resources\DigitBikeResource;
use App\Resources\HdfcErgoTwResource;
use App\Resources\HdfcErgoCarResource;
use App\Resources\FgiTwResource;

use App\Partners\Care\Care;
use App\Partners\Manipal\Manipal;
use App\Partners\Digit\DigitHealth;
    
class TestController extends Controller{
    public $uniqueToken;
    public function __construct() { 
       $this->DigitBikeResource  = new DigitBikeResource;
       $this->DigitCarResource =   new DigitCarResource;
       $this->HdfcErgoTwResource =  new HdfcErgoTwResource;
       $this->HdfcErgoCarResource =  new HdfcErgoCarResource;
       $this->FgiTw =  new FgiTwResource;
        
       $this->Care =   new Care;
       $this->Manipal  =  new Manipal;
       $this->DigitHealth  =  new DigitHealth;
   }
     
     function testPartnerBug(Request $request){
        header('Content-Type: application/json');
        $this->HdfcErgoTwResource->bugReport();
    }
    
    
     public function testany(){
        
         //  $path =  public_path('/site_assets/financers.json');
        //   $content = json_decode(file_get_contents($path), true);
        
        // $results =  $content['Data'];
         // foreach($results as $res){ 
            // print_r($res);
            // DB::table('financiers')->insertGetId(['name'=>$res['Name'],'hdfcErgoCode'=>$res['Value']]);
             	 
       //  }
        
        
        // $temp_vehicles_car_hdfcMap  = DB::table("temp_vehicles_car_hdfcMap")->get();
        //   foreach($temp_vehicles_car_hdfcMap as $row){
        //       DB::table("vehicle_variant_car")->where('digit_code',$row->digit_code)->update(['hdfcErgo_code'=>$row->hdfcErgo_code]);  
        //   }
        //   $path =  public_path('/js/hdfc-car-model.json');
        //   $content = json_decode(file_get_contents($path), true);
        
        //   $results =  $content['data'];
        //   foreach($results as $res){
        //      if(DB::table('temp_hdfc_car_model')->where('ModelId', $res['ModelId'])->doesntExist()){
        //         DB::table('temp_hdfc_car_model')->insertGetId(['MakeId'=>$res['MakeId'],'ModelId'=>$res['ModelId'],'ModelName'=>$res['ModelName'],
        //                                                       'VariantName'=>$res['VariantName'],'FuelType'=>$res['FuelType'], 
        //                                                       'CubicCapacity'=> $res['CubicCapacity']]);
        //           print_r($res);
        //           echo "</br></hr></br>";
        //     }
             
        //   }
        
        
    //   $data = getMailSmsInfo(6,"POSP_FEE_PAID");
    //   print_r($data);
       // sendNotification($data);
        //  $template = ['title' => 'TEST-ANY',"subtitle"=>"TEST",'body'=>$data->email->body];  
        //   return View::make('emailTemplate.frame')->with($template);
        
        //  $states = DB::table("states")->get();
        //  foreach($states as $st){
        //      $isExist = DB::table("pincode_master12")->where('State',$st->name)->count();
        //  }
        
        //   $cities = DB::table("cities")->get();
        //      foreach($cities as $ct){
        //          $isExist = DB::table("cities")->where('id',$ct->id)->update(['name'=>ucfirst(strtolower($ct->name))]);
        //      }
        
        
       //  $pinmasters  = DB::table("pincode_masters")->get();
        //  foreach($pinmasters as $row){
        //         $cnt = DB::table("cities")->where('name',ucfirst(strtolower($row->District)))->count();
        //         if($cnt){
        //             $ct = DB::table("cities")->where('name',ucfirst(strtolower($row->District)))->first();
        //              DB::table("pincode_masters")->where('id',$row->id)->update(['city_id'=>$ct->id]);
        //         }
        //      $isExist = DB::table("cities")->where('state_id',$row->state_id)->where('name',$row->District)->count();
        //      $cityID =0;
        //      if($isExist){
        //         $cityID =  DB::table("cities")->where('state_id',$row->state_id)->where('name',$row->District)->value('id');
        //      }else{
        //          $cityID = DB::table('cities')->insertGetId(['state_id' =>$row->state_id, 'name' =>$row->District]);
        //      }
             
        //      print_r($row);
        //      echo "</br></hr></br>";
         //}
        
        //  $rto_masters = DB::table("rto_master")->get();
        //  foreach($rto_masters as $row){
        //       DB::table("rtoMaster")->where('rtoCode',$row->region_code)->update(['hdfcErgoCodeTw'=>$row->hdfcErgoRtoCode]);
        //  }
        
        //  $path =  public_path('/site_assets/hdfcCity.json');
        //  $content = json_decode(file_get_contents($path), true);
        
        //  $results =  $content['results'];
        //  foreach($results as $res){
        //      if(DB::table('cities')->where('hdfcErgoCode', $res['CityId'])->doesntExist()) {
        //           DB::table('cities')->whereRaw('LOWER(name) = ?', [strtolower($res['CityName'])])->update(['hdfcErgoCode' => $res['CityId']]);
        //           print_r($res);
        //           echo "</br></hr></br>";
        //     }
             
        //  }
        
        //  $rtos = DB::table("rtoMaster")->where('city_id',0)->get();
        //  foreach($rtos as $res){
        //      DB::table("rtoMaster")->where('id',$res->id)->update(['rtoCode'=>trim($res->rtoCode)]);
            //  $strArr = explode(',',$res->text);
            //  $str = $strArr[0];
            //   $cnt  =DB::table('cities')->whereRaw('LOWER(name) = ?', [strtolower($str)])->count();
            //   if($cnt){
            //          $f=  DB::table('cities')->whereRaw('LOWER(name) = ?', [strtolower($str)])->first();
            //           DB::table("rtoMaster")->where('id',$res->id)->update(['city_id'=>$f->id]);
                   
                     
            //      }
                 
            // print_r($res);
            //echo "</br></hr></br>";
       //  }
       
       
        //  $path =  public_path('/js/hdfc-car-model.json');
        //  $content = json_decode(file_get_contents($path), true);
        
        //  $results =  $content['results'];
        //  foreach($results as $res){
        //      if(DB::table('temp_hdfc_city_code')->where('cityCode', $res['CityId'])->doesntExist()) {
        //          DB::table('temp_hdfc_city_code')->insertGetId(['cityCode' =>$res['CityId'],'CityName' =>$res['CityName']]);
        //           print_r($res);
        //           echo "</br></hr></br>";
        //     }
             
        //  }
        
        
    //   $temps = DB::table("temp_state_city_rto")->whereBetween('id', [783, 795])->get();
    //     foreach($temps as $res){
            
                //   print_r($res);
                //   echo "</br></hr></br>";
            
            // if(DB::table('rtoMaster')->where('rtoCode', $res->rto)->doesntExist()) {
            //       DB::table('rtoMaster')->insertGetId(['rtoCode'=>$res->rto,'text'=>$res->city,'city_id'=>$res->cityId,'hdfcErgoCodeTw' =>$res->rtoCodeTw,'hdfcErgoCodeCar' =>$res->rtoCodeCar]);
            // }
            // if(DB::table('cities')->where('name', ucfirst(strtolower($res->city)))->doesntExist()) {
            //      $cityId =  DB::table('cities')->insertGetId(['hdfcErgoCode' =>$res->cityCode,'name' =>ucfirst(strtolower($res->city))]);
            // }else{
            //     $cityId = DB::table('cities')->where('name', ucfirst(strtolower($res->city)))->value('id');
            // }
            // DB::table("temp_state_city_rto")->where('id',$res->id)->update(['cityId'=>$cityId]);
            
            // if(DB::table('rtoMaster')->where('rtoCode', $res->rto)->doesntExist()) {
            //       $text =  ucfirst(strtolower($res->city));
            //       DB::table('rtoMaster')->insertGetId(['rtoCode'=>$res->rto,'text'=>$text,'city_id'=>$res->cityId,'hdfcErgoCodeTw' =>$res->rtoCodeTw,'hdfcErgoCodeCar' =>$res->rtoCodeCar]);
            // }
           // DB::table("temp_state_city_rto")->where('id',$res->id)->update(['cityId'=>$cityId]);
           
            // if(DB::table('states')->where('hdfcErgoCode', ucfirst(strtolower($res->stateCode)))->doesntExist()) {
            //      $stateId =  DB::table('states')->insertGetId(['hdfcErgoCode' =>$res->stateCode,'name' =>ucfirst(strtolower($res->state))]);
            // }else{
            //      $stateId = DB::table('states')->where('hdfcErgoCode', $res->stateCode)->value('id');
            // }
            // DB::table("temp_state_city_rto")->where('id',$res->id)->update(['stateId'=>$stateId]);
            // DB::table("cities")->where('id',$res->cityId)->update(['state_id'=>$stateId]);
            
       // }
       
       
        // $temps = DB::table("medical_questions")->whereBetween('id', [58, 69])->get();
        // foreach($temps as $res){ 
        //     $childs = DB::table("medical_questions")->where('parentId', 57)->get();
        //     foreach($childs as $ch){
        //         $ch->parentId = $res->id;
        //         $array = json_decode(json_encode($ch), true);
        //         unset($array["id"]);
        //         DB::table('medical_questions')->insertGetId($array);
        //     }
        // }
        
    }

    
    
    
   
}