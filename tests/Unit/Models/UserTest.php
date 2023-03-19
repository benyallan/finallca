<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testUserHasNameEmailPasswordAttributes()
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ]);

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('johndoe@example.com', $user->email);
        $this->assertTrue(password_verify('password', $user->password));
    }

    public function testUserHiddenAttributes()
    {
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $this->assertArrayNotHasKey('password', $user->toArray());
        $this->assertArrayHasKey('email', $user->toArray());
        $this->assertArrayNotHasKey('remember_token', $user->toArray());
        $this->assertArrayNotHasKey('api_token', $user->toArray());
    }

    public function testUserCastedAttributes()
    {
        $user = User::factory()->create([
            'email_verified_at' => '2022-03-05 12:00:00',
        ]);

        $this->assertInstanceOf(\DateTimeInterface::class, $user->email_verified_at);
        $this->assertEquals('2022-03-05 12:00:00', $user->email_verified_at->format('Y-m-d H:i:s'));
    }
}
