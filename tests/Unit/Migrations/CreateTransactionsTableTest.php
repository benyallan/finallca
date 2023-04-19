<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateTransactionsTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCreditCardTransactionsTableMigration(): void
    {
        $fields = [
            'id',
            'user_id',
            'belonging_to_type',
            'belonging_to_id',
            'accountable_type',
            'accountable_id',
            'date',
            'currency_code',
            'transaction_amount',
            'description',
            'done',
            'direction',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        $this->assertTrue(Schema::hasTable('transactions'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('transactions', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('transactions')) === count($fields));
    }

    public function testDropCreditCardTransactionTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('transactions'));
    }
}
