<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;

use App\Utils\Posp;

class PosphdfcErgoCodeGeneration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posphdfccode:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'POSP unique code generate for HDFC Ergo';

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
    public function handle()
    {
         
           
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
         $results = DB::table('agents')->whereNull('hdfcErgoCode')->where('status','Inforce')->get();
         foreach($results as $each){
             if($each->hdfcErgoCode=="" && $each->status=='Inforce'){ 
                    $res = $this->posp->createPOSPcode($each);
                    if($res->status===true){
                        DB::table('agents')->where('id',$each->id)->update(['hdfcErgoCode'=>$res->code]);
                       Log::channel('cronlog')->info($each->posp_ID.'- Code Created:'.$res->code);
                    }else{
                        Log::channel('cronlog')->info($each->posp_ID.'-'.$res->message);
                    }
             }else{
                 Log::channel('cronlog')->info($each->posp_ID.'- Code is already exist or not iNforce yet');
             }
         }
        //$this->info('Inspection:Cron Cummand Run successfully!');
    }
}
