<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreatePasswordResetTokensTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreatePasswordResetTokensTableMigration(): void
    {
        $fields = [
            'email',
            'token',
            'created_at'
        ];
        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('password_reset_tokens'));

        $this->assertEquals(Schema::getColumnListing('password_reset_tokens'), $fields);
    }

    public function testDropPasswordResetTokensTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('password_reset_tokens'));
    }
}
