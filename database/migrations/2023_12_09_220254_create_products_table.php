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
        Schema::disableForeignKeyConstraints();

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->text('description')->nullable();
            $table->float('cost')->nullable();
            $table->float('price')->nullable();
            $table->unsignedInteger('stock_quantity')->nullable();
            $table->boolean('published')->default(false);

            $table->unsignedInteger('category_id')->default(1);
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
