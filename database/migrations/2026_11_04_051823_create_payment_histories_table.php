<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_histories', function (Blueprint $table) {
           $table->id();

        $table->string('user_name');
        $table->string('phone', 20);
        $table->string('address');
        $table->string('order_code')->unique();

        // $table->string('total_amt');
        $table->unsignedBigInteger('total_amt');
        $table->string('payment_method');
        $table->string('payslip_image');

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_histories');
    }
};
