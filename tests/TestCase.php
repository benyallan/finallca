<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh');
        $this->user = \App\Models\User::factory()->create();
        $this->actingAs($this->user);
    }
}
