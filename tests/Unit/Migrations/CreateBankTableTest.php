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
        $fields = [
            'id',
            'user_id',
            'number',
            'name',
            'deleted_at',
            'created_at',
            'updated_at',
        ];
        Artisan::call('migrate:fresh --seed');

        $this->assertTrue(Schema::hasTable('banks'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('banks', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('banks')) === count($fields));
    }

    public function testDropBankTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('banks'));
    }
}
