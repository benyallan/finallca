<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CreateFailedJobsTableTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateFailedJobsTableMigration(): void
    {
        $fields = [
            'id',
            'uuid',
            'connection',
            'queue',
            'payload',
            'exception',
            'failed_at',
        ];

        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('failed_jobs'));

        $this->assertEquals(Schema::getColumnListing('failed_jobs'), $fields);

        $this->assertTrue(Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('failed_jobs')['failed_jobs_uuid_unique']->isUnique());
    }

    public function testDropFailedJobsTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('failed_jobs'));
    }
}
