<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pathao_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id')->nullable();
            $table->string('consignment_id')->unique()->nullable();
            $table->string('merchant_order_id')->nullable();
            $table->string('store_id')->nullable();
            $table->string('order_status')->default('Pending');
            $table->string('order_status_slug')->nullable();
            $table->decimal('delivery_fee', 10, 2)->default(0.00);
            $table->string('recipient_name')->nullable();
            $table->string('recipient_phone')->nullable();
            $table->text('recipient_address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->json('tracking_data')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index('order_id');
            $table->index('consignment_id');
            $table->index('merchant_order_id');
            $table->index('order_status');
            $table->index('store_id');

            // Foreign key constraint
            $table->foreign('order_id')
                  ->references('id')
                  ->on('orders')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pathao_orders');
    }
};