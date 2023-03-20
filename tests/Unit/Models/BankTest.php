<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use App\Models\Bank;
use App\Enums\AccountType;

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
        $bank = Bank::factory()->create([
            'number' => '100',
            'name' => 'Banco do Brasil',
        ]);

        $this->assertEquals('100', $bank->number);
        $this->assertEquals('Banco do Brasil', $bank->name);
    }
}
