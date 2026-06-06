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
            $table->customer_id();
            $table->tablre_id();
            $table->waiter_id();
            $table->cashier_id();
            $table->cooker_id();
            $table->discount_id();
            $table->boolean('discount_applied')->default(false);
            $table->string('order_type', 100)->default('dine-in') ;
            $table->string('status', 100)->default('pending') ;
            $table->decimal('total_amount', 8, 2)->default(0.00);
            $table->decimal('discount_amount', 8, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamps();
            
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->order_id();
            $table->product_id();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 8, 2)->default(0.00);
            $table->deciaml('subtotal', 8, 2)->default(0.00);
            $table->text('notes')->nullable();
            $table->timestamps();
          
        });
        Schema::create('order_status_logs', function (Blueprint $table) {
            $table->id();
            $table->order_id();
            $table->changee_id();
            $table->string('old_status', 100);
            $table->string('new_status', 100);
            $table->timestamp('changed_at')->useCurrent();
            $table->timestamps();
           
        });
        Schema::create('stock_logs', function (Blueprint $table) {
            $table->id();
            $table->product_id();
            $table->order_id();
            $table->integer('changed_by' )->nullable();
            $table->integer('change_qty') ->default(0);
            $table->string('reason', 255);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('order_status_logs');
        Schema::dropIfExists('stock_logs');
    }
};
