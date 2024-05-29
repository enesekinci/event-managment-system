<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventDeleteRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Http\Requests\EventViewAnyRequest;
use App\Http\Requests\EventViewRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function index(EventViewAnyRequest $request): JsonResponse
    {
        return response()->json(data: [
            'status' => true,
            'events' => EventResource::collection($request->user()->events()->get()),
        ]);
    }

    public function show(EventViewRequest $request, Event $event): JsonResponse
    {
        return response()->json(data: [
            'status' => true,
            'event' => new EventResource($event),
        ]);
    }

    public function store(EventCreateRequest $request)
    {
        $event = $request->user()->events()->create([
            'name' => $request->string('name')->trim(),
            'description' => $request->string('description')->trim(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(data: [
            'status' => true,
            'event' => new EventResource($event),
        ], status: 201);
    }

    public function update(EventUpdateRequest $request, Event $event)
    {
        $event->update([
            'name' => $request->string('name')->trim(),
            'description' => $request->string('description')->trim(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return response()->json(data: [
            'status' => true,
            'event' => new EventResource($event),
        ]);
    }

    public function destroy(EventDeleteRequest $request, Event $event)
    {
        $event->delete();

        return response()->json(data: [
            'status' => true,
            'event' => new EventResource($event),
        ], status: 204);
    }
}
