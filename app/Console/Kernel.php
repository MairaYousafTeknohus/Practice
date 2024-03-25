<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\SendEmailJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        Commands\SendEmailJob::class,
    ];
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call('App\Http\Controllers\NewCOntroller@table_mail')->everyMinute();
        // $schedule->command('emails:send')->everyMinute();
    }

    protected function commands(): void
    {
        
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
