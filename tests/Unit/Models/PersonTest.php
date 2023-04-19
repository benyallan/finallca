<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function testPersonHasCorrectAttributes()
    {
        $user = User::factory()->create();

        $person = Person::factory()->forUser($user)->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $this->assertEquals('John Doe', $person->name);
        $this->assertEquals('johndoe@example.com', $person->email);
        $this->assertEquals($user->id, $person->user_id);
    }
}
