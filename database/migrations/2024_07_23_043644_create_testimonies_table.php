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
        Schema::create('testimonies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('users_id')->nullable()->default(null);
            $table->uuid('transactions_detail_id');
            $table->uuid('travel_packages_id');

            $table->string('name');
            $table->text('message');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('transactions_detail_id')->references('id')->on('transaction_details')->onDelete('cascade');
            $table->foreign('travel_packages_id')->references('id')->on('travel_packages')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonies');
    }
};
