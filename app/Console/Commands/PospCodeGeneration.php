<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;

use App\Utils\Posp;

class PospCodeGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pospcode:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'POSP unique code generate for POSP';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }
    
    public function __construct() { 
           parent::__construct();
           $this->posp   = new Posp; 
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(){
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
         $results = DB::table('agents')->where('status','Inforce')->get();
         foreach($results as $each){
            if($each->hdfcErgoCode=="" && $each->status=='Inforce'){ 
                    $hdfc = $this->posp->HdfcPospCode($each);
                    if($hdfc->status===true){
                       DB::table('agents')->where('id',$each->id)->update(['hdfcErgoCode'=>$res->code]);
                       Log::channel('cronlog')->info("HDFCERGO : ".$each->posp_ID.'- Code Created:'.$res->code);
                    }else{
                      Log::channel('cronlog')->info("HDFCERGO : ".$hdfc->message);  
                    }
            }else{
                Log::channel('cronlog')->info($each->posp_ID.'-Code is already exist or not enforce yet - HDFCERGO');
            }
            
            if($each->fgiCode=="" && $each->status=='Inforce'){ 
                    $Fgi = $this->posp->FgiPospCode($each);
                    if($Fgi->status===true){
                         DB::table('agents')->where('id',$each->id)->update(['fgiCode'=>$res->code]);
                        Log::channel('cronlog')->info("FGI :".$each->posp_ID.'- Code Created:'.$res->code);
                    }else{
                      Log::channel('cronlog')->info("FGI : ".$Fgi->message);  
                    }
                    
            }else{
                Log::channel('cronlog')->info($each->posp_ID.'-Code is already exist or not enforce yet - FGI');
            }
         }
        //$this->info('Inspection:Cron Command Run successfully!');
    }
}
