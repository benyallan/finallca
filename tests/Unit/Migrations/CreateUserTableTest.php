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
        // Executa a migration
        Artisan::call('migrate');

        // Verifica se a tabela "users" existe no banco de dados
        $this->assertTrue(Schema::hasTable('users'));

        // Verifica se as colunas da tabela "users" foram criadas corretamente
        $this->assertTrue(Schema::hasColumns('users', [
            'id', 'name', 'email', 'email_verified_at', 'password', 'remember_token', 'created_at', 'updated_at',
        ]));
    }

    /**
     * Test if the users table is dropped.
     *
     * @return void
     */
    public function testDropUserTable(): void
    {
        // Run the migration
        Artisan::call('migrate');

        // Drop the table
        Artisan::call('migrate:rollback');

        // Assert that the table doesn't exist
        $this->assertFalse(Schema::hasTable('users'));
    }
}
