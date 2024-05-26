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
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('travel_packages_id');
            $table->uuid('users_id')->nullable();
            $table->integer('additional_visa');
            $table->integer('transaction_total');
            $table->string('transaction_status'); //IN_CART, PENDING, SUCCESS, CANCAEL, FAILED
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('travel_packages_id')->references('id')->on('travel_packages')->onDelete('cascade');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
