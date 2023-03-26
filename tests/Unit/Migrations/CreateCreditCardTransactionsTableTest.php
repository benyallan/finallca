<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateCreditCardTransactionsTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCreditCardTransactionsTableMigration(): void
    {
        $fields = [
            'id',
            'user_id',
            'credit_card_id',
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

        $this->assertTrue(Schema::hasTable('credit_card_transactions'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('credit_card_transactions', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('credit_card_transactions')) === count($fields));
    }

    public function testDropCreditCardTransactionTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('credit_card_transactions'));
    }
}
