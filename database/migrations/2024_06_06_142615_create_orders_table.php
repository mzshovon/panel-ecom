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
            $table->integer('quantity');
            $table->float('total_amount');
            $table->float('total_discount')->default(0);
            $table->float('total_amount_after_discount');
            $table->integer('shipping_charge')->default(0);
            $table->enum('payment_type', ['Cash on delivery', 'Payment Gateway']);
            $table->string('name');
            $table->string('mobile');
            $table->string('email')->nullable(true);
            $table->longText('address')->nullable(true);
            $table->longText('notes')->nullable(true);
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
