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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('table_id')->nullable();
            $table->unsignedBigInteger('waiter_id')->nullable();
            $table->unsignedBigInteger('cashier_id')->nullable();
            $table->unsignedBigInteger('cooker_id')->nullable();
            $table->unsignedBigInteger('discount_id')->nullable();
            $table->boolean('discount_applied')->default(false);
            $table->string('order_type', 100)->default('dine-in');
            $table->string('status', 100)->default('pending');
            $table->decimal('total_amount', 8, 2)->default(0.00);
            $table->decimal('discount_amount', 8, 2)->default(0.00);
            $table->decimal('final_amount', 8, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 8, 2)->default(0.00);
            $table->decimal('subtotal', 8, 2)->default(0.00);
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->string('old_status', 100);
            $table->string('new_status', 100);
            $table->timestamp('changed_at')->useCurrent();
            $table->timestamps();
        });

        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('changed_by')->nullable();
            $table->integer('change_qty')->default(0);
            $table->string('reason', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
        Schema::dropIfExists('order_status_logs');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
