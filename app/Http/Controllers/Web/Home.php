<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
class Home extends Controller{
    public function __construct() { }

 
     public function index(){
         $Categories = DB::table('categories')->select('*')->where('on_front',1)->orderBy('sno','ASC')->get(); 
         $partners = DB::table('our_partners')->where(['status'=>'ACTIVE'])->get();
         $template = ['title' => 'Home',"subtitle"=>"Insurance", 'categories'=> $Categories,'partners'=>$partners];  
         return View::make('web.home.home')->with($template);
    }
    
     public function aboutus(){
       
        $template = ['title' => 'About Us',"subtitle"=>"About Us"];  
         return View::make('web.home.about')->with($template);
       
    }
     public function contact(){
       
        $template = ['title' => 'Contact Us',"subtitle"=>"Contact Us"];  
         return View::make('web.home.contact')->with($template);
       
    }
    
    public function sendContactMail(Request $request){
        
         $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'phone' => 'required|digits:10',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        if($validator->fails()) {
           $error = $validator->errors()->all();
           return response()->json(['status'=>"error",'message'=>current($error)]);
        }else{
            $contactData = ['name' =>$request->name,'email' =>$request->email,'phone' =>$request->phone,'note' =>$request->message];
            $to_name ="Care Super Finserv"; $to_email ="care@superfinserv.com";$mobile=$request->mobile;
            Mail::send('web.home.contactMail', $contactData, function($message) use ($to_name, $to_email) {
              $message->to($to_email, $to_name)
              ->subject('New Enquiry');
             $message->from('care@superfinserv.com',config('custom.site_short_name'));
            });
            
            $custname = $request->name;$custemail= $request->email;
            Mail::send('web.home.contactMailCustmer', $contactData, function($message) use ($custname, $custemail) {
              $message->to($custemail, $custname)
              ->subject('Your query is registered');
             $message->from('care@superfinserv.com',config('custom.site_short_name'));
            });
            return response()->json(['status'=>"success",'message'=>"Success! Email sent , we will contact you soon."]);
        }
        // 
        // print_r($contactData);
    }
    
    public function artical(){
       
        $template = ['title' => 'Artical',"subtitle"=>"Artical"];  
         return View::make('web.home.artical')->with($template);
       
    }
    
     public function shipping(){
        $template = ['title' => 'Insurance supersolutions',"subtitle"=>"Shipping"];  
         return View::make('web.home.shipping')->with($template);
    }
    
    public function privacy(){
        $template = ['title' => 'Insurance supersolutions',"subtitle"=>"Shipping"];  
         return View::make('web.home.privacy')->with($template);
    }
    
     public function disclaimer(){
        $template = ['title' => 'Insurance supersolutions',"subtitle"=>"Shipping"];  
         return View::make('web.home.disclaimer')->with($template);
    }
    
    public function terms(){
        $template = ['title' => 'Insurance supersolutions',"subtitle"=>"Shipping"];  
         return View::make('web.home.terms-condition')->with($template);
    }
    
     public function ClaimsAssistance(){
        $Categories = DB::table('categories')->get(); 
        $template = ['title' => 'Claims Assistance',"subtitle"=>"Claims Assistance",'categories'=>$Categories,'scripts'=>[asset('page_js/claims_assistance.js?v=0.01')]];    
        return View::make('web.home.claims_assistance')->with($template);
       
    }
    
    public function claimMyRequest(Request $request){
        $data['referenceId'] = date('Ymdhis');
        $data['insurance'] = $request->insuranceType;
        $data['policy_no'] = strtoupper($request->PolicyNumber);
        $data['name'] = $request->name;
        $data['mobile'] = $request->MobileNumber;
        $data['email'] = $request->email;
        $data['message'] = $request->comment;
        $id = DB::table('claims_assistance')->insertGetId($data);
        if($id){
              unset($data['message']);
              $data['comment'] = $request->comment;
              $custname =  $request->name;
              $custemail =  $request->email;
              $subject = 'New Claim Query - '.$data['referenceId'];
              $data['sfLogo'] = asset('site_assets/logo/'.config('custom.site_logo'));
              Mail::send('insurance.email-template.claims-assistance', $data, function($message) use ($subject,$custname, $custemail) {
              $message->to([$custemail,'care@superfinserv.com'])
                      ->subject($subject);
             $message->from('care@superfinserv.com',config('custom.site_short_name'));
            });
            return response()->json(['status'=>'success','message'=>'your claim registered successfully','data'=>[]]);
        }else{
            return response()->json(['status'=>'error','message'=>'opps! somthing went wrong try again!','data'=>$cities]);
        }
    }
    
    // public function modelsNew(){
    //   $tests =  DB::table('temp_vehicles')
    //                       ->select('*')
    //                       ->where('id', '>=', 20001) 
    //                       ->where('id', '<=', 27000) ->get();
    //                       $i=1;
    //   foreach($tests as $row){
    //       $hasVar =  DB::table('vehicle_variant')->where('digit_code',$row->digit_code)->count();
    //       $strMake =  trim(ucwords($row->make));
    //       $strModal = trim(ucwords($row->modal));
    //       if(!$hasVar){
    //             $hasMake =  DB::table('vehicle_make')->where('make',$strMake)->where('vehicle_type',$row->vehicle_type)->count();
    //             if($hasMake){
    //               $make = DB::table('vehicle_make')->where('make',$strMake)->where('vehicle_type',$row->vehicle_type)->first();
    //               $makeID = $make->id;
    //             }else{
    //               $makeID =  DB::table('vehicle_make')->insertGetId(['make'=>ucwords($row->make),'vehicle_type'=>$row->vehicle_type]);
    //             }
               
             
    //           $hasmodal = DB::table('vehicle_modal')->where('make_id',$make->id)->where('modal',$strModal)->count();
    //           if($hasmodal){
    //               $modal = DB::table('vehicle_modal')->where('make_id',$make->id)->where('modal',$strModal)->first();
    //               $modalID  = $modal->id;
    //           }else{
    //                 $modalID =  DB::table('vehicle_modal')->insertGetId(['make_id'=>$makeID,'modal'=>$strModal]);
    //           }
               
    //           $array['modal_id'] = $modalID;
    //           $array['make_id'] = $makeID;
    //           $array['digit_code'] = $row->digit_code;
    //           $array['make'] = $row->make;
    //           $array['modal'] = $row->modal;
    //           $array['variant'] = $row->variant;
    //           $array['body_type'] = $row->body_type;
    //           $array['seating_capacity'] = $row->seating_capacity;
    //           $array['power'] = $row->power;
    //           $array['cubic_capacity'] = $row->cubic_capacity;
    //           $array['grosss_weight'] = $row->grosss_weight;
    //           $array['fuel_type'] = $row->fuel_type;
    //           $array['wheels'] = $row->wheels;
    //           $array['abs'] = $row->abs;
    //           $array['air_bags'] = $row->air_bags;
    //           $array['_length'] = $row->_length;
    //           $array['showroom_price'] = $row->showroom_price;
    //           $array['price_year'] =$row->price_year;
    //           $array['production'] =$row->production;
    //           $array['manufacturing'] =$row->manufacturing;
    //           $array['vehicle_type'] =$row->vehicle_type;
    //           $id = DB::table('vehicle_variant')->insertGetId($array);
    //           echo "<br/>";
    //       }else{
    //           echo $i.":-NO<br/>";
    //       }
    //       $i++;
    //   }
    // }
}


