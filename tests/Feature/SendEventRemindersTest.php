<?php

namespace Tests\Feature;

use App\Mail\EventReminder;
use App\Models\Event;
use App\Models\Registration;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithConsoleEvents;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendEventRemindersTest extends TestCase
{
    use RefreshDatabase, WithConsoleEvents;

    #[Test]
    public function send_reminders_command()
    {
        $event = Event::factory()->create([
            'start_time' => now()->addMinutes(61),
        ]);

        Registration::factory()
            ->count(10)
            ->create([
                'event_id' => $event->id,
            ]);

        Carbon::setTestNow(now()->addMinutes(60));

        $this->withoutExceptionHandling();

        Mail::fake();

        $this->artisan('reminders:send')
            ->assertExitCode(0);

        Mail::assertSent(EventReminder::class);
    }
}
