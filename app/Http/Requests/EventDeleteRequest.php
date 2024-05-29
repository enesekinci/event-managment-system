<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Event;
use Illuminate\Foundation\Http\FormRequest;

class EventDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            abilities: 'delete',
            arguments: $this->route('event'),
        );
    }
}
