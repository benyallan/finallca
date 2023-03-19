<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateAUserWithDefaultAttributes()
    {
        $user = \App\Models\User::factory()->create();

        $this->assertNotNull($user);
        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);
        $this->assertNotNull($user->email_verified_at);
        $this->assertNotEmpty($user->remember_token);
    }

    public function testItCanCreateAnUnverifiedUser()
    {
        $user = \App\Models\User::factory()->unverified()->create();

        $this->assertNotNull($user);
        $this->assertNotEmpty($user->name);
        $this->assertNotEmpty($user->email);
        $this->assertNotEmpty($user->password);
        $this->assertNull($user->email_verified_at);
        $this->assertNotEmpty($user->remember_token);
    }
}
