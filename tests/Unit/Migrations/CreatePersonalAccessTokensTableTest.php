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

    public function testCreatePersonalAccessTokensTable(): void
    {
        $fields = [
            'id',
            'tokenable_type',
            'tokenable_id',
            'name',
            'token',
            'abilities',
            'last_used_at',
            'expires_at',
            'created_at',
            'updated_at',
        ];
        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('personal_access_tokens'));

        $this->assertEquals(Schema::getColumnListing('personal_access_tokens'), $fields);
    }

    public function testDropPersonalAccessTokensTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('personal_access_tokens'));
    }
}
