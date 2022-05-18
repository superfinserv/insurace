<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;
use Carbon\Carbon;

use App\Utils\OrcCalculate;

class OrcCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orc:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate ORC at the end of the day.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    
    public function __construct() { 
           parent::__construct();
           $this->orc = new OrcCalculate;
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
        
        // ->whereNotIn('policy_saled.policy_no',function($QUERY) {
        //              $QUERY->select('policy_no')->from('policy_commissions');
        //         })
         $yesterday = Carbon::now()->subDays(1)->format('Y-m-d');
         $todaysSale = DB::table('policy_saled')
                       ->whereDate('date', $yesterday)
                       ->get();
         foreach($todaysSale as $each){
              $this->orc->calculateAndSave($each->policy_no);
              //Log::channel('cronlog')->info($each->policy_no.'- Commision Calculate');
         }
         
        //$this->info('Inspection:Cron Cummand Run successfully!');
    }
}
