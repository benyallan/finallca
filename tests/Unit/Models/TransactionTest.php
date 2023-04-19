<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\Transaction\Direction;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_transaction(): void
    {
        $transaction = Transaction::factory()->create();

        $this->assertInstanceOf(Transaction::class, $transaction);
        $this->assertNotNull($transaction->id);
    }

    public function test_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $transaction = Transaction::factory()->forUser($user)->create();

        $this->assertInstanceOf(User::class, $transaction->user);
        $this->assertEquals($user->id, $transaction->user->id);
    }

    public function test_morph_to_accountable(): void
    {
        $transaction = Transaction::factory()->create();

        $this->assertNotNull($transaction->accountable);
    }

    public function test_belongs_to_related_transaction(): void
    {
        $relatedTransaction = Transaction::factory()->create();
        $transaction = Transaction::factory()->create([
            'related_transaction_id' => $relatedTransaction->id,
        ]);

        $this->assertInstanceOf(Transaction::class, $transaction->relatedTransaction);
        $this->assertEquals($relatedTransaction->id, $transaction->relatedTransaction->id);
    }

    public function test_casts(): void
    {
        $transaction = Transaction::factory()->create([
            'transaction_amount' => '50.00',
            'direction' => Direction::IN,
            'due_date' => '2023-05-01',
            'completed_at' => '2023-04-10',
        ]);

        $this->assertIsNumeric($transaction->transaction_amount);
        $this->assertEquals(50.00, $transaction->transaction_amount);

        $this->assertInstanceOf(Direction::class, $transaction->direction);
        $this->assertEquals(Direction::IN, $transaction->direction);

        $this->assertInstanceOf(\Carbon\Carbon::class, $transaction->due_date);
        $this->assertEquals('2023-05-01', $transaction->due_date->format('Y-m-d'));

        $this->assertInstanceOf(\Carbon\Carbon::class, $transaction->completed_at);
        $this->assertEquals('2023-04-10', $transaction->completed_at->format('Y-m-d'));
    }
}
