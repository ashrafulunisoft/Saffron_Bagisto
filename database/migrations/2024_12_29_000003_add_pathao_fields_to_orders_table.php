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
        Schema::table('orders', function (Blueprint $table) {
            // Add Pathao consignment ID field
            if (!Schema::hasColumn('orders', 'pathao_consignment_id')) {
                $table->string('pathao_consignment_id')->nullable()->after('cart_id');
            }

            // Add Pathao tracking enabled flag
            if (!Schema::hasColumn('orders', 'pathao_tracking_enabled')) {
                $table->boolean('pathao_tracking_enabled')->default(false)->after('pathao_consignment_id');
            }

            // Add index for pathao_consignment_id for performance
            if (Schema::hasColumn('orders', 'pathao_consignment_id')) {
                $table->index('pathao_consignment_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'pathao_consignment_id')) {
                $table->dropIndex(['pathao_consignment_id']);
                $table->dropColumn(['pathao_consignment_id', 'pathao_tracking_enabled']);
            }
        });
    }
};
