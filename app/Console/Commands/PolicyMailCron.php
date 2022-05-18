<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use DB;

use App\Utils\PolicyMail;

class PolicyMailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'policymail:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail to customer';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    
    
    public function __construct() { 
           parent::__construct();
           $this->policymail = new PolicyMail;
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
                
         $Sales = DB::table('policy_saled')
                       ->where('MailStatus', 'No')
                       ->get();
         foreach($Sales as $each){
              $this->policymail->calculateAndSendMail($each->policy_no);
              //Log::channel('cronlog')->info($each->policy_no.'- Commision Calculate');
         }
         
        //$this->info('Inspection:Cron Cummand Run successfully!');
    }
}
