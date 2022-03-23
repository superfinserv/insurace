<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class HomeController extends Controller{
    
    public function __construct() { 
       // $this->appUtil = $appUtil; 
      // $this->middleware('guest:admin')->except('logout');
   }

    public function index(){
         //$this->logm();
        // echo Hash::make("Finserv@2021");
         $template = ['title' => 'Home',"subtitle"=>"Dashboard",
                     'scripts'=>[
                               
                                asset('admin/lib/chartist/chartist.min.js'),
                                asset('admin/lib/echarts/echarts.min.js'),
                                asset('admin/js/ResizeSensor.js'),
                                asset('admin/js/page/dashboard-chart.js'),
                                asset('admin/js/page/dashboard.js')
                         ]
                        ];  
                      return View::make('admin.home.home')->with($template);
                     
      
    }
    
    
    public function getPOSPStatistic(Request $request){
        if($request->tab=='ALL' ){
             $query =  DB::table("agents")
                    ->select(DB::raw("COUNT(*) AS Recruited"),
                             DB::raw("COUNT(CASE WHEN status = '1' && isVerified='1' THEN 1 END) AS Active"),
                             DB::raw("COUNT(CASE WHEN is_trashed = 'YES' THEN 1 END) AS Trash"),
                             DB::raw("COUNT(CASE WHEN is_tranning_complete = 'NO' THEN 1 END) AS Untra"))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
        }else if($request->tab=='MTD'){
             $query =  DB::table("agents")
                    ->select(DB::raw("COUNT(*) AS Recruited"),
                             DB::raw("COUNT(CASE WHEN status = '1' && isVerified='1' THEN 1 END) AS Active"),
                             DB::raw("COUNT(CASE WHEN is_trashed = 'YES' THEN 1 END) AS Trash"),
                             DB::raw("COUNT(CASE WHEN is_tranning_complete = 'NO' THEN 1 END) AS Untra"))
                      ->whereMonth('created_at', date('m'))
                      ->whereYear('created_at', date('Y'))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
            
        }else if($request->tab=='YTD'){
             $query =  DB::table("agents")
                    ->select(DB::raw("COUNT(*) AS Recruited"),
                             DB::raw("COUNT(CASE WHEN status = '1' && isVerified='1' THEN 1 END) AS Active"),
                             DB::raw("COUNT(CASE WHEN is_trashed = 'YES' THEN 1 END) AS Trash"),
                             DB::raw("COUNT(CASE WHEN is_tranning_complete = 'NO' THEN 1 END) AS Untra"))
                     ->whereYear('created_at', date('Y'))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
            
        }
    }
    
    public function getNOPStatistic(Request $request){
        if($request->tab=='ALL' ){
             $query =  DB::table("policy_saled")
                    ->select(DB::raw("COUNT(*) AS allSale"),
                             DB::raw("COUNT(CASE WHEN type = 'LIFE' THEN 1 END) AS Life"),
                             DB::raw("COUNT(CASE WHEN type = 'HEALTH' THEN 1 END) AS Health"),
                             DB::raw("COUNT(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN 1 END) AS Motor"),
                             DB::raw("COUNT(CASE WHEN type = 'OTHR' THEN 1 END) AS NonMotor"))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
        }else if($request->tab=='MTD'){
             $query =  DB::table("policy_saled")
                    ->select(DB::raw("COUNT(*) AS allSale"),
                             DB::raw("COUNT(CASE WHEN type = 'LIFE'  THEN 1 END) AS Life"),
                             DB::raw("COUNT(CASE WHEN type = 'HEALTH' THEN 1 END) AS Health"),
                             DB::raw("COUNT(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN 1 END) AS Motor"),
                             DB::raw("COUNT(CASE WHEN type = 'OTHR' THEN 1 END) AS NonMotor"))
                      ->whereMonth('date', date('m'))
                      ->whereYear('date', date('Y'))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
            
        }else if($request->tab=='YTD'){
             $query =  DB::table("policy_saled")
                    ->select(DB::raw("COUNT(*) AS allSale"),
                             DB::raw("COUNT(CASE WHEN type = 'LIFE'  THEN 1 END) AS Life"),
                             DB::raw("COUNT(CASE WHEN type = 'HEALTH' THEN 1 END) AS Health"),
                             DB::raw("COUNT(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN 1 END) AS Motor"),
                             DB::raw("COUNT(CASE WHEN type = 'OTHR' THEN 1 END) AS NonMotor"))
                     ->whereYear('date', date('Y'))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
            
        }
    }
    
    public function getPremiumStatistic(Request $request){
        if($request->tab=='ALL' ){
             $query =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE' THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
        }else if($request->tab=='MTD'){
             $query =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE'  THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                      ->whereMonth('date', date('m'))
                      ->whereYear('date', date('Y'))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
            
        }else if($request->tab=='YTD'){
             $query =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE'  THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                     ->whereYear('date', date('Y'))
                    ->first();
                 return Response::json(['status'=>'success','data'=>$query]);
            
        }
    }
    
    public function getSalesStatistic(Request $request){
         $data['today'] =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),DB::raw("COUNT(*) AS noPolicy"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE' THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                    ->whereDate('date', date('Y-m-d'))
                    ->first();
        $data['today']->totalSale = setMoneyFormat($data['today']->totalSale);
        $data['today']->Health = setMoneyFormat($data['today']->Health);
        $data['today']->Motor = setMoneyFormat($data['today']->Motor);
                    
        $data['week'] =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),DB::raw("COUNT(*) AS noPolicy"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE' THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                    ->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->first();
        $data['week']->totalSale = setMoneyFormat($data['week']->totalSale);
        $data['week']->Health = setMoneyFormat($data['week']->Health);
        $data['week']->Motor = setMoneyFormat($data['week']->Motor);
                    
        $data['month'] =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),DB::raw("COUNT(*) AS noPolicy"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE' THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                     ->whereMonth('date', date('m'))
                     ->whereYear('date', date('Y'))
                     ->first();
        $data['month']->totalSale = setMoneyFormat($data['month']->totalSale);
        $data['month']->Health = setMoneyFormat($data['month']->Health);
        $data['month']->Motor = setMoneyFormat($data['month']->Motor);
                     
        $data['year'] =  DB::table("policy_saled")
                    ->select(DB::raw("ROUND(SUM(amount),2) AS totalSale"),DB::raw("COUNT(*) AS noPolicy"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'LIFE' THEN amount ELSE 0 END),2) AS Life"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'HEALTH' THEN amount ELSE 0 END),2) AS Health"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'CAR' OR type = 'BIKE' THEN amount ELSE 0 END),2) AS Motor"),
                             DB::raw("ROUND(SUM(CASE WHEN type = 'OTHR' THEN amount ELSE 0 END),2) AS NonMotor"))
                     ->whereYear('date', date('Y'))
                     ->first();
        $data['year']->totalSale = setMoneyFormat($data['year']->totalSale);
        $data['year']->Health = setMoneyFormat($data['year']->Health);
        $data['year']->Motor = setMoneyFormat($data['year']->Motor);
                     
         return Response::json(['status'=>'success','data'=>$data]);
    }
    
    public function testany(){
        
         //   $path =  public_path('/site_assets/financers.json');
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
    
    
    
    public function mail(){
        $to_name = 'Praveen Patidar';
        $to_email = 'praveen.patidar10@gmail.com';
        $data = array('name'=>'Cloudways (sender_name)', "body" => "A test mail");
          
        Mail::send('emailTemplate.mailtest', $data, function($message) use ($to_name, $to_email) {
        $message->to($to_email, $to_name)
        ->subject('Laravel Test Mail');
        $message->from('care@supersolutions.in','Test Mail');
        });
           
           echo 'Email sent Successfully';
     }
        
        

    

      function logout(){
        Auth::logout();
        return redirect('/login');
      }
      
}
