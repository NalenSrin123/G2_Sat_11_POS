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
        Schema::create('kitchen_queues', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->enum('status', [
                'pending',
                'acknowledged',
                'cooking',
                'ready'
            ])->default('pending');
            $table->integer('priority')->default(0);
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->boolean('notified_waiter')->default(false);
             $table->timestamp('queued_at')->nullable();
            $table->timestamp('acked_at')->nullable();
            $table->timestamp('ready_at')->nullable();
            $table->timestamp('notified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_queues');
    }
};
