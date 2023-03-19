<?php

namespace Tests\Unit\Filament\Resources;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserResourceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    /** @test */
    public function it_can_get_eloquent_query()
    {
        $query = UserResource::getEloquentQuery();

        $this->assertInstanceOf(Builder::class, $query);
    }

    /** @test */
    // public function it_can_get_form()
    // {
    //     $form = UserResource::form(new Form());

    //     $this->assertInstanceOf(Form::class, $form);
    //     // dump(array_keys($form->getSchema()));
    //     dd(array_keys($form->getSchema()));
    //     $this->assertEquals([
    //         TextInput::make('id')
    //             ->maxLength(36)
    //             ->disabled()
    //             ->hiddenOn('create'),
    //         TextInput::make('name')
    //             ->required()
    //             ->maxLength(255)
    //             ->label('Nome'),
    //         TextInput::make('email')
    //             ->email()
    //             ->required()
    //             ->maxLength(255)
    //             ->label('E-mail'),
    //         TextInput::make('password')
    //             ->password()
    //             ->required()
    //             ->maxLength(255)
    //             ->label('Senha'),
    //         TextInput::make('email_verified_at')
    //             ->label('E-mail verificado')
    //     ], $form->getSchema());
    // }

    /** @test */
    // public function it_can_get_table()
    // {
    //     $table = UserResource::table(new Table());

    //     $this->assertInstanceOf(Table::class, $table);
    //     $this->assertEquals([
    //         'id' => [
    //             'hidden' => true,
    //             'sortable' => false,
    //         ],
    //         'name' => [
    //             'label' => 'Nome',
    //             'sortable' => true,
    //         ],
    //         'email' => [
    //             'label' => 'E-mail',
    //             'sortable' => true,
    //         ],
    //         'email_verified_at' => [
    //             'hidden' => true,
    //             'label' => 'E-mail verificado',
    //             'sortable' => false,
    //         ],
    //         'deleted_at' => [
    //             'hidden' => true,
    //             'label' => 'Excluído em',
    //             'sortable' => false,
    //         ],
    //         'created_at' => [
    //             'hidden' => true,
    //             'label' => 'Criado em',
    //             'sortable' => true,
    //         ],
    //         'updated_at' => [
    //             'hidden' => true,
    //             'label' => 'Última atualização',
    //             'sortable' => true,
    //         ],
    //     ], $table->getColumns());
    // }

    /** @test */
    public function it_can_get_relations()
    {
        $relations = UserResource::getRelations();

        $this->assertIsArray($relations);
        $this->assertEmpty($relations);
    }

    /** @test */
    public function it_can_get_pages()
    {
        $pages = UserResource::getPages();

        $this->assertIsArray($pages);
        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('view', $pages);
        $this->assertArrayHasKey('edit', $pages);
    }
}
