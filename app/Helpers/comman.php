<?php 
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
 
 
 if (!function_exists('clean_str')) {
    function clean_str($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $string = str_replace('-', '', $string); 
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // //Removes special chars.
    }
 }   