<?php

declare(strict_types=1);

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BankFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testItCanCreateABanktWithDefaultAttributes()
    {
        $bank = \App\Models\Bank::factory()->create();

        $this->assertNotNull($bank);
        $this->assertNotEmpty($bank->number);
        $this->assertNotEmpty($bank->name);
    }
}
