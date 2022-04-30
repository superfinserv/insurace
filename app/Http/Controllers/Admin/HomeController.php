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
