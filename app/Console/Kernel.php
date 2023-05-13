<?php

namespace App\Console;

use App\Models\Student;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $students = Student::all();
        $schedule->call(function () use ($students) {
            foreach ($students as $student) {
                $student->attendances()->create([
                    'is_present' => false,
                    'date' => now()->toDateString(),
                ]);

            }  foreach ($students as $student) {
                $student->attendances()->create([
                    'is_present' => false,
                    'date' => now()->addDay()->toDateString(),
                ]);
            }
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
