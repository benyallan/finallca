<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAccountTableMigration(): void
    {
        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('accounts'));

        $this->assertTrue(Schema::hasColumns('accounts', [
            'id', 'description', 'opening_balance', 'balance', 'type',
            'user_id', 'bank_id', 'number',
            'limit', 'income', 'maintenance_fee',
            'created_at', 'updated_at', 'deleted_at',
        ]));
    }

    public function testDropAccountTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('accounts'));
    }
}
