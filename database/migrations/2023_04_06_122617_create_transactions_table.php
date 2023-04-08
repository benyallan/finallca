<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignUuid('related_transaction_id')->nullable();
            $table->uuidMorphs('accountable');
            $table->date('due_date')->nullable();
            $table->string('currency_code')->default('BRL');
            $table->decimal('transaction_amount', 15, 2);
            $table->string('description');
            $table->date('completed_at')->nullable();
            $table->string('direction');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
