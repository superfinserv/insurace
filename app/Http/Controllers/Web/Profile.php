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
class Profile extends Controller{
    public function __construct() { 
        
    }

 
    public function index(){
         $polices = DB::table('policy_saled')->where('mobile_no',Auth::guard('customers')->user()->mobile)->get();
         $template = ['title' => 'Super Finserv',"subtitle"=>"Profile",'polices'=>$polices];  
         return View::make('web.profile.index')->with($template);
    }
    
    function logout(){
         Auth::guard('customers')->logout();
        return redirect('/');
    }
    
  
}


