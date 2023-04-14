<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateABanktWithDefaultAttributes()
    {
        $bank = \App\Models\Bank::factory()->create();

        $this->assertNotNull($bank);
        $this->assertNotEmpty($bank->name);
        $this->assertInstanceOf(\App\Models\User::class, $bank->user);
    }

    public function testItCanCreateABankWithGivenUser()
    {
        $user = \App\Models\User::factory()->create();
        $bank = \App\Models\Bank::factory()->forUser($user)->create();

        $this->assertNotNull($bank);
        $this->assertNotEmpty($bank->name);
        $this->assertInstanceOf(\App\Models\User::class, $bank->user);
        $this->assertEquals($bank->user_id, $user->id);
    }
}
