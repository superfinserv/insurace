<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    // function setEnv($name, $value){
    //         $path = base_path('.env');
    //         if (file_exists($path)) {
    //             file_put_contents($path, str_replace(
    //                 $name . '=' . env($name), $name . '=' . $value, file_get_contents($path)
    //             ));
    //         }
    // }
}
