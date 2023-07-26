<?php

namespace Selvah\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Backup Database
        //$schedule->command('backup:clean')->daily()->at('01:00');
        //$schedule->command('backup:run')->daily()->at('01:30');
        $schedule->command('backup:clean')->everyTenMinutes();
        $schedule->command('backup:run')->everyTenMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
