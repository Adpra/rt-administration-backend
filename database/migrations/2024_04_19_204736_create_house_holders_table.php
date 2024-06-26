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
        Schema::create('house_holders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('photo_ktp')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->string('marital_status');
            $table->string('phone');
            $table->integer('house_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('house_holders');
    }
};
