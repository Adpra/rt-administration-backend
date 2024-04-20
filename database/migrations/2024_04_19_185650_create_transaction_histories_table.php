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
        Schema::create('transaction_histories', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->tinyInteger('status');
            $table->float('amount');
            $table->string('description')->nullable();
            $table->integer('house_id')->nullable();
            $table->integer('householder_id')->nullable();
            $table->integer('billing_id')->nullable();
            $table->timestamp('next_billing_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_histories');
    }
};
