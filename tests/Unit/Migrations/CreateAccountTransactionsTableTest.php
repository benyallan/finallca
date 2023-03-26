<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateAccountTransactionsTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateAccountTransactionsTableMigration(): void
    {
        $fields = [
            'id',
            'user_id',
            'account_id',
            'description',
            'value',
            'type',
            'date',
            'direction',
            'status',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('account_transactions'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('account_transactions', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('account_transactions')) === count($fields));
    }

    public function testDropAccountTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('account_transactions'));
    }
}
