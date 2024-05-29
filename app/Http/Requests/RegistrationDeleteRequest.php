<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Registration;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationDeleteRequest extends FormRequest
{

    public function authorize(): bool
    {
        return $this->user()->can(
            abilities: 'delete',
            arguments: Registration::class,
        );
    }
}
