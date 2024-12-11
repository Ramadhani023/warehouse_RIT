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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('product_category');
            $table->integer('product_qty');
            $table->unsignedBigInteger('warehouse_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('serial')->nullable();
            $table->string('manufaktur')->nullable();
            $table->date('last_inspection')->nullable();
            $table->date('next_inspection')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
