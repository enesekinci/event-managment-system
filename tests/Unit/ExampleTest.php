<?php

namespace Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    #[Test]
    public function example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
