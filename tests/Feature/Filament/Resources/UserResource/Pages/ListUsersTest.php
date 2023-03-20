<?php

declare(strict_types=1);

namespace Tests\Feature\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Tests\Unit\Filament\Resources\UserResourceTest;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('migrate:fresh --seed');
    }

    /** @test */
    public function it_can_render_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->get(UserResource::getUrl('index'))->assertStatus(403);
    }
}
