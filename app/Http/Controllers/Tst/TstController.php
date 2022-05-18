<?php
namespace App\Http\Controllers\Tst;
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
class TstController extends Controller{
    public function __construct() { }

 
     public function ipndex(Request $request){
         echo $request->posp;
         echo "<br/>";
        $name = DB::table('agents')->select('name','email','mobile')->where('api_token', $request->posp)->first();
         print_r($name);
    }
}