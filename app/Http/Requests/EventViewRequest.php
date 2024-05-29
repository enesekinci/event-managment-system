<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventViewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can(
            abilities: 'view',
            arguments: $this->route(param: 'event')
        );
    }
}
