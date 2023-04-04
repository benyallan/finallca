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
        $fields = [
            'id',
            'user_id',
            'name',
            'email',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('people'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('people', $field));
        }

        $this->assertEquals(count($fields), count(Schema::getColumnListing('people')));
    }

    public function testDropPersonTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('people'));
    }
}
