<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testPersonHasCorrectAttributes()
    {
        $user = User::factory()->create();

        $person = Person::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone_number' => '1234567890',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('John Doe', $person->name);
        $this->assertEquals('johndoe@example.com', $person->email);
        $this->assertEquals('1234567890', $person->phone_number);
        $this->assertEquals($user->id, $person->user_id);
    }
}
