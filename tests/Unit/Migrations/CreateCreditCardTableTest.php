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
        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('credit_cards'));

        $this->assertTrue(Schema::hasColumns('credit_cards', [
            'id',
            'name',
            'description',
            'closing_day',
            'due_day',
            'limit',
            'user_id',
            'bank_id',
            'direct_debit',
            'person_id',
            'created_at',
            'updated_at',
            'deleted_at',
        ]));
    }

    public function testDropCreditCardTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('credit_cards'));
    }
}
