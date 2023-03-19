<?php

namespace Tests\Feature\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }

    /** @test */
    public function it_can_render_page()
    {
        $this->get(UserResource::getUrl('index'))->assertSuccessful();
    }
}
