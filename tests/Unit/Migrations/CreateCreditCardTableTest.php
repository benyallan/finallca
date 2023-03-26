<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateCreditCardTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateCreditCardsTableMigration(): void
    {
        $fields = [
            'id',
            'user_id',
            'person_id',
            'bank_id',
            'brand',
            'description',
            'closing_day',
            'due_day',
            'limit',
            'direct_debit',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('credit_cards'));

        $this->assertEquals(Schema::getColumnListing('credit_cards'), $fields);
    }

    public function testDropCreditCardTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('credit_cards'));
    }
}
