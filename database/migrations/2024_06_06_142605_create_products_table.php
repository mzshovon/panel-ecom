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
            $table->string('name');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->string('sku')->unique();
            $table->bigInteger('stock')->default(0);
            $table->decimal('price', 10, 2);
            $table->decimal('previous_price', 10, 2)->nullable();
            $table->date('tentative_delivery_date')->nullable();
            $table->decimal('weight', 8, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('discount_level', 8, 2)->default(0)->nullable();
            $table->enum('discount_type', ['percentage', 'amount'])->nullable();
            $table->json('variants')->nullable();
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->softDeletes();
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
