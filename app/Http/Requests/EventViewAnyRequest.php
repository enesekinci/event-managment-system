<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;

class EventViewAnyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            abilities: 'view-any',
            arguments: Event::class
        );
    }
}
