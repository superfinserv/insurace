<?php
namespace App\Http\Controllers\Admin;
//namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use File;
use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
class Login extends Controller{
    //  public function __construct(AppUtil $appUtil) { 
    //     $this->appUtil = $appUtil; 
    //     $this->middleware('auth');
    //  }    

     public function index(){
       $this->middleware('guest:admins')->except('logout');
       if(Auth::guard('admin')->user()){ return redirect('home');}
        $template = ['title' => 'Admistrator',"subtitle"=>"Admistrator Login"];
        return View::make('admin.auth.login')->with($template);
      
    }
    
    public function getAuth(Request $request){
         //print_r($_POST);
         $this->middleware('guest:admin')->except('logout');
         if(Auth::guard('admin')->attempt(['email' =>$request->email,'password'=>$request->password],1)) { 
            return Response::json(array('status'=>'success','message'=>"Authenticate success! redirecting...."));
        }else{
            return Response::json(array('status'=>'error','message'=>"Invalid email or password"));
        }
    }

     
    
}
 

