<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankTest extends TestCase
{
    use RefreshDatabase;

    public function testBankHasCorrectAttributes()
    {
        $user = User::factory()->create();

        $bank = Bank::factory()->forUser($user)->create([
            'name' => 'Banco do Brasil',
        ]);

        $this->assertEquals('Banco do Brasil', $bank->name);
        $this->assertEquals($user->id, $bank->user_id);
    }
}
