<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;

use App\Resources\HdfcErgoCarResource;
use App\Resources\DigitCarResource;

class InspectionCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspection:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get updates on if inspection status changed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     parent::__construct();
    // }
    
    public function __construct(DigitCarResource $DigitCarResource ,HdfcErgoCarResource $HdfcErgoCarResource) { 
           parent::__construct();
           $this->DigitCar   = $DigitCarResource; 
           $this->HdfcErgoCar= $HdfcErgoCarResource; 
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
         $cases = DB::table('app_quote')->where('isBreakInCase','YES')->whereIn('breakInStatus',['Pending', 'Initiated', 'Approved'])->get();
         foreach($cases as $each){
            $breakIn =  json_decode($each->breakInJson,true);
            $res = $this->HdfcErgoCar->GetBreakinDetails($breakIn['BreakinId'],$breakIn['QuoteId']);
              DB::table('app_quote')->where('id',$each->id)->update(['breakInStatus'=>$res['BreakInStatus']]);
              Log::channel('cronlog')->info($each->enquiry_id.'- Inspection status is : '.$res['BreakInStatus']);
         }
        $this->info('Inspection:Cron Cummand Run successfully!');
    }
}
