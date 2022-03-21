<?php

namespace App\Http\Controllers\Pos;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use View;
use Session; 
use Auth;
use App\User;
class HomeController extends Controller{
    public function __construct() { }

     public function index(){
      
        $template = ['title' => 'Super Finserv',"subtitle"=>"Become Agent"];  
         return View::make('pos.front.home')->with($template);
    }
    
     public function faq(){
        $template = ['title' => 'Super Finserv',"subtitle"=>"POSP FAQ"];  
         return View::make('pos.front.faq')->with($template);
    }
    
    public function terms(){
        $template = ['title' => 'Super Finserv',"subtitle"=>"POSP Terms & Conditoins"];  
         return View::make('pos.front.terms_conditions')->with($template);
    }
 
 
}
