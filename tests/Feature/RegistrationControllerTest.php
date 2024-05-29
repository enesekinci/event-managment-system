<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegistrationControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_register_for_an_event()
    {
        $user = User::factory()->create();

        $event = Event::factory()->create();

        Passport::actingAs($user);

        $response = $this->postJson(route('events.register', $event));

        $response->assertStatus(201);
    }

    #[Test]
    public function a_user_can_unregister_from_an_event()
    {
        $user = User::factory()->create();

        $event = Event::factory()->create();

        Passport::actingAs($user);

        $event->registrations()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->deleteJson(route('events.unregister', $event));

        $response->assertStatus(204);
    }
}
