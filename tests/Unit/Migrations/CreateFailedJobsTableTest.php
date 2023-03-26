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

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('failed_jobs', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('failed_jobs')) === count($fields));

        $this->assertTrue(Schema::getConnection()->getDoctrineSchemaManager()->listTableIndexes('failed_jobs')['failed_jobs_uuid_unique']->isUnique());
    }

    public function testDropFailedJobsTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('failed_jobs'));
    }
}
