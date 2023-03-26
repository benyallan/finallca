<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateAccountTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAccountTableMigration(): void
    {
        $fields = [
            'id',
            'bank_id',
            'user_id',
            'person_id',
            'description',
            'opening_balance',
            'balance',
            'type',
            'number',
            'limit',
            'income',
            'maintenance_fee',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('accounts'));

        $this->assertEquals(Schema::getColumnListing('accounts'), $fields);
    }

    public function testDropAccountTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('accounts'));
    }
}
