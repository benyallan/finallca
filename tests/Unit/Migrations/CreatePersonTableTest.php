<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreatePersonTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePersonTableMigration(): void
    {
        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('people'));

        $this->assertTrue(Schema::hasColumns('people', [
            'id',
            'name',
            'email',
            'phone_number',
            'user_id',
            'deleted_at',
            'created_at',
            'updated_at',
        ]));
    }

    public function testDropPersonTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('people'));
    }
}
