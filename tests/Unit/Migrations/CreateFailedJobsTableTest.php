<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateFailedJobsTableTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test if the migration creates the "failed_jobs" table.
     *
     * @return void
     */
    public function testCreateFailedJobsTableMigration(): void
    {
        // Executa a migration
        Artisan::call('migrate');

        // Verifica se a tabela "failed_jobs" existe no banco de dados
        $this->assertTrue(Schema::hasTable('failed_jobs'));

        // Verifica se as colunas esperadas existem na tabela "failed_jobs"
        $this->assertTrue(Schema::hasColumns('failed_jobs', [
            'id',
            'uuid',
            'connection',
            'queue',
            'payload',
            'exception',
            'failed_at',
        ]));

        // Verifica se a coluna "uuid" é única
        $this->assertTrue(Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('failed_jobs')['failed_jobs_uuid_unique']->isUnique());
    }

    /**
     * Test if the failed jobs table is dropped.
     *
     * @return void
     */
    public function testDropFailedJobsTable(): void
    {
        // Run the migration
        Artisan::call('migrate');

        // Drop the table
        Artisan::call('migrate:rollback');

        // Assert that the table doesn't exist
        $this->assertFalse(Schema::hasTable('failed_jobs'));
    }
}
