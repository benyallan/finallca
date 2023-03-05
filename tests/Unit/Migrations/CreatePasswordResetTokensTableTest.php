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
        // Executa a migration
        Artisan::call('migrate');

        // Verifica se a tabela "password_reset_tokens" existe no banco de dados
        $this->assertTrue(Schema::hasTable('password_reset_tokens'));

        // Verifica se as colunas da tabela "users" foram criadas corretamente
        $this->assertTrue(Schema::hasColumns('password_reset_tokens', [
            'email', 'token', 'created_at',
        ]));
    }

    /**
     * Test if the password reset tokens table is dropped.
     *
     * @return void
     */
    public function testDropPasswordResetTokensTable(): void
    {
        // Run the migration
        Artisan::call('migrate');

        // Drop the table
        Artisan::call('migrate:rollback');

        // Assert that the table doesn't exist
        $this->assertFalse(Schema::hasTable('password_reset_tokens'));
    }
}
