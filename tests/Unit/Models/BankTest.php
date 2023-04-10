<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Bank;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class BankTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    public function testBankHasNameAndNumberAttributes()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $bank = Bank::factory()->create([
            'name' => 'Banco do Brasil',
            'user_id' => $user->id,
        ]);

        $this->assertEquals('Banco do Brasil', $bank->name);
        $this->assertEquals($user->id, $bank->user_id);
    }
}
