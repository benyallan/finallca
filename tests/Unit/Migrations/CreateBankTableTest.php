<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateBankTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateBankTableMigration(): void
    {
        Artisan::call('migrate:fresh --seed');

        $this->assertTrue(Schema::hasTable('banks'));

        $this->assertTrue(Schema::hasColumns('banks', [
            'number', 'name', 'user_id',
            'created_at', 'updated_at', 'deleted_at',
        ]));
    }

    public function testDropBankTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('banks'));
    }
}
