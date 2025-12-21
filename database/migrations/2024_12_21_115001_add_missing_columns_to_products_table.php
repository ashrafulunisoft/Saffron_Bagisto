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
        Schema::table('products', function (Blueprint $table) {
            // Add missing columns from documentation
            if (!Schema::hasColumn('products', 'name')) {
                $table->string('name')->after('sku');
            }

            if (!Schema::hasColumn('products', 'name_bn')) {
                $table->string('name_bn')->nullable()->after('name');
            }

            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->after('name_bn');
            }

            if (!Schema::hasColumn('products', 'description_bn')) {
                $table->text('description_bn')->nullable()->after('description');
            }

            if (!Schema::hasColumn('products', 'base_price')) {
                $table->decimal('base_price', 10, 2)->after('description_bn');
            }

            if (!Schema::hasColumn('products', 'compare_price')) {
                $table->decimal('compare_price', 10, 2)->nullable()->after('base_price');
            }

            if (!Schema::hasColumn('products', 'cost_price')) {
                $table->decimal('cost_price', 10, 2)->nullable()->after('compare_price');
            }

            if (!Schema::hasColumn('products', 'stock_quantity')) {
                $table->integer('stock_quantity')->default(0)->after('cost_price');
            }

            if (!Schema::hasColumn('products', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('stock_quantity');
            }

            // Add soft deletes if not exists
            if (!Schema::hasColumn('products', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['name', 'name_bn', 'description', 'description_bn', 'base_price', 'compare_price', 'cost_price', 'stock_quantity', 'is_active', 'deleted_at']);
        });
    }
};
