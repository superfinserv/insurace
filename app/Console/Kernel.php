<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
         Commands\InspectionCron::class,
         Commands\OrcCron::class,
         Commands\PolicyMailCron::class,
         Commands\PospCodeGeneration::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('inspection:cron')->hourly();
        $schedule->command('orc:cron')->dailyAt('05:00');
        $schedule->command('poscode:cron')->daily();
        $schedule->command('policymail:cron')->everyFiveMinutes();//hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
