<?php
namespace App\Console;

use App\Models\PaymentSchedule;
use App\Notifications\LoanScheduleReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $this->sendReminders();
        })->dailyAt('09:00');
    }

    protected function sendReminders()
    {
        $today = Carbon::now();

        // Fetch payment schedules that are not paid and due within the next week
        PaymentSchedule::where('is_paid', false) // Use boolean value for `is_paid`
            ->whereBetween('due_date', [$today, $today->copy()->addWeek()])
            ->chunk(100, function ($schedules) use ($today) {
                foreach ($schedules as $schedule) {
                    try {
                        $daysBefore = $schedule->due_date->diffInDays($today);

                        // Get the loan associated with the payment schedule
                        $loan = $schedule->loan;

                        // Get the client associated with the loan
                        $client = $loan->client;

                        if ($client) {
                            // Send reminders based on days before due date
                            if ($daysBefore <= 7 && $daysBefore > 3) {
                                // Send first reminder
                                Notification::send($client, new LoanScheduleReminder($schedule, $daysBefore));
                            } elseif ($daysBefore <= 3 && $daysBefore > 1) {
                                // Send second reminder
                                Notification::send($client, new LoanScheduleReminder($schedule, $daysBefore));
                            } elseif ($daysBefore == 1) {
                                // Send final reminder
                                Notification::send($client, new LoanScheduleReminder($schedule, $daysBefore));
                            }
                        }
                    } catch (\Exception $e) {
                        Log::error('Failed to send reminder for payment schedule ID ' . $schedule->id . ': ' . $e->getMessage());
                    }
                }
            });
    }


}
