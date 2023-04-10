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
            'user_id',
            'bank_id',
            'person_id',
            'description',
            'opening_balance',
            'balance',
            'type',
            'account_limit',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('accounts'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('accounts', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('accounts')) === count($fields));
    }

    public function testDropAccountTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('accounts'));
    }
}
