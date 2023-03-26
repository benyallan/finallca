<?php

declare(strict_types=1);

namespace Tests\Unit\Migrations;

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
            'abilities',
            'created_at',
            'expires_at',
            'id',
            'last_used_at',
            'name',
            'token',
            'tokenable_id',
            'tokenable_type',
            'updated_at',
        ];
        Artisan::call('migrate');

        $this->assertTrue(Schema::hasTable('personal_access_tokens'));

        foreach ($fields as $field) {
            $this->assertTrue(Schema::hasColumn('personal_access_tokens', $field));
        }

        $this->assertTrue(count(Schema::getColumnListing('personal_access_tokens')) === count($fields));
    }

    public function testDropPersonalAccessTokensTable(): void
    {
        Artisan::call('migrate');

        Artisan::call('migrate:rollback');

        $this->assertFalse(Schema::hasTable('personal_access_tokens'));
    }
}
