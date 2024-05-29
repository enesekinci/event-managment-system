<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventReminder extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Event $event)
    {
    }

    public function build(): EventReminder
    {
        return $this->view('emails.reminder')
            ->with([
                'eventName' => $this->event->name,
                'eventDescription' => $this->event->description,
                'eventStartTime' => $this->event->start_time,
            ]);
    }
}
