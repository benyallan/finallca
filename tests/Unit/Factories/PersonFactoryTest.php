<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateAPersonWithDefaultAttributes()
    {
        $person = \App\Models\Person::factory()->create();

        $this->assertNotNull($person);
        $this->assertNotEmpty($person->name);
        $this->assertNotEmpty($person->email);
        $this->assertInstanceOf(\App\Models\User::class, $person->user);
    }
}
