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
        Schema::table('orders', function (Blueprint $table) {
            $table->json("status_update_info")->after("status")->nullable();
            $table->string("invoice_no", 300)->after("id")->nullable();
            $table->string("merchant_id", 400)->after("invoice_no")->nullable();
            $table->enum("courier", config('website.courier'))->after("merchant_id")->nullable();
            $table->enum("order_from", config('website.order_from'))->after("payment_type")->default("facebook");
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
};
