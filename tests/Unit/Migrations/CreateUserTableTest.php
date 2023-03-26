<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateUserTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUserTableMigration(): void
    {
        $fields = [
            'id',
            'name',
            'email',
            'email_verified_at',
            'password',
            'remember_token',
            'deleted_at',
            'created_at',
            'updated_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('users'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('users', $field));
        }

        $this->assertEquals(count($fields), count(Schema::getColumnListing('users')));
    }

    public function testDropUserTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('users'));
    }
}
