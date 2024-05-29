<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationCreateRequest;
use App\Http\Requests\RegistrationDeleteRequest;
use App\Http\Resources\RegistrationResource;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    public function store(RegistrationCreateRequest $request, Event $event): JsonResponse
    {
        $registration = Registration::query()
            ->firstOrCreate([
                'user_id' => $request->user()->id,
                'event_id' => $event->id,
            ]);

        return response()->json(data: [
            'status' => true,
            'registration' => new RegistrationResource($registration),
        ], status: 201);
    }

    public function destroy(RegistrationDeleteRequest $request, Event $event): JsonResponse
    {
        $request->user()->registrations()->where('event_id', $event->id)->delete();

        return response()->json(data: [
            'status' => true,
            'registration' => null,
        ], status: 204);
    }
}
