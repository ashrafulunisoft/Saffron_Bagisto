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
        Schema::create('pathao_tracking_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pathao_order_id');
            $table->string('status')->nullable();
            $table->string('status_slug')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('location_name')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('timestamp')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index('pathao_order_id');
            $table->index('status');
            $table->index('timestamp');

            // Foreign key constraint
            $table->foreign('pathao_order_id')
                  ->references('id')
                  ->on('pathao_orders')
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
        Schema::dropIfExists('pathao_tracking_history');
    }
};
