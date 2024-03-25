<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendEmailJob;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $details = ['email' => '5107.2019.gct@gmail.com'];
        SendEmailJob::dispatch($details);
    }
}
