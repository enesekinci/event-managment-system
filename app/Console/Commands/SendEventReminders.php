<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Mail\EventReminder;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventReminders extends Command
{
    protected $signature = 'reminders:send';

    protected $description = 'Send event reminders to registered users';

    public function handle(): void
    {
        $events = Event::query()
            ->with('registrations.user')
            ->where('start_time', '<=', Carbon::now()->addHour())
            ->where('start_time', '>', Carbon::now())
            ->get();

        foreach ($events as $event) {
            foreach ($event->registrations as $registration) {
                Mail::to($registration->user->email)->send(new EventReminder($event));
            }
        }
    }
}
