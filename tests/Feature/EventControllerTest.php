<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_customer_can_view_events()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $response = $this->getJson(route('events.index'));

        $response->assertStatus(200);
    }

    #[Test]
    public function a_customer_cant_view_other_customers_events()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Passport::actingAs($user);

        Event::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->getJson(route('events.index'));

        $response->assertStatus(200);
        $response->assertJsonCount(0, 'events');
    }

    #[Test]
    public function a_customer_can_view_a_single_event()
    {
        $user = User::factory()->create();

        Passport::actingAs($user);

        $event = Event::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->getJson(route('events.show', $event));

        $response->assertStatus(200);
    }

    #[Test]
    public function a_customer_can_create_an_event()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $response = $this->postJson(route('events.store'), [
            'name' => 'Test Event',
            'description' => 'Test Description',
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDay()->addHour()->toDateTimeString(),
        ]);

        $response->assertStatus(201);
    }

    #[Test]
    public function a_customer_can_update_an_event()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $event = Event::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->putJson(route('events.update', $event), [
            'name' => 'Updated Event',
            'description' => 'Updated Description',
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDay()->addHour()->toDateTimeString(),
        ]);

        $response->assertStatus(200);
    }

    #[Test]
    public function a_customer_cant_update_other_customers_event()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Passport::actingAs($user);

        $event = Event::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->putJson(route('events.update', $event), [
            'name' => 'Updated Event',
            'description' => 'Updated Description',
            'start_time' => now()->addDay()->toDateTimeString(),
            'end_time' => now()->addDay()->addHour()->toDateTimeString(),
        ]);

        $response->assertStatus(403);
    }

    #[Test]
    public function a_customer_can_delete_an_event()
    {
        $user = User::factory()->create();
        Passport::actingAs($user);

        $event = Event::factory()->create([
            'user_id' => $user->id,
        ]);

        $response = $this->deleteJson(route('events.destroy', $event));

        $response->assertStatus(204);
    }

    #[Test]
    public function a_customer_cant_delete_other_customers_event()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        Passport::actingAs($user);

        $event = Event::factory()->create([
            'user_id' => $otherUser->id,
        ]);

        $response = $this->deleteJson(route('events.destroy', $event));

        $response->assertStatus(403);
    }
}
