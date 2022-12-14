<?php

namespace App\Console;

use App\Jobs\ResolvePatientEmailIssueJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\Scheduled\ScheduledResolveOrdersWithoutInvoicesJob;
use App\Jobs\Scheduled\ScheduledResolveTestBookingsWithoutOrdersJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->job(new ScheduledResolveTestBookingsWithoutOrdersJob())->hourlyAt('02');
        $schedule->job(new ScheduledResolveOrdersWithoutInvoicesJob())->hourlyAt('04');
        $schedule->job(new ResolvePatientEmailIssueJob())->everyTenMinutes();
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
