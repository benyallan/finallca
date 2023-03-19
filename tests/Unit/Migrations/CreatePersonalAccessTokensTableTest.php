<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreatePersonalAccessTokensTableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the personal access tokens table is created.
     */
    public function testCreatePersonalAccessTokensTable(): void
    {
        // Run the migration
        Artisan::call('migrate');

        // Assert that the table exists
        $this->assertTrue(Schema::hasTable('personal_access_tokens'));

        // Assert that the columns exist
        $this->assertTrue(Schema::hasColumns('personal_access_tokens', [
            'id',
            'tokenable_id',
            'tokenable_type',
            'name',
            'token',
            'abilities',
            'last_used_at',
            'expires_at',
            'created_at',
            'updated_at',
        ]));
    }

    /**
     * Test if the personal access tokens table is dropped.
     */
    public function testDropPersonalAccessTokensTable(): void
    {
        // Run the migration
        Artisan::call('migrate');

        // Drop the table
        Artisan::call('migrate:rollback');

        // Assert that the table doesn't exist
        $this->assertFalse(Schema::hasTable('personal_access_tokens'));
    }
}
