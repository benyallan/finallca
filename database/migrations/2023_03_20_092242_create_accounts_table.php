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
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('bank_id')->constrained()->cascadeOnDelete();
            // $table->foreignUuid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('person_id')->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->double('opening_balance');
            $table->double('balance');
            $table->string('type');
            $table->string('number');
            $table->double('limit')->nullable();
            $table->boolean('income')->default(false);
            $table->float('maintenance_fee')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
