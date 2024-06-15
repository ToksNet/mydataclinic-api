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
        Schema::create('new_01j0404dwewzmnx0gdwrvn30bm', function (Blueprint $table) {
            $table->ulid('id')->primary();
             
            $table->string('name')->nullable();
             
            $table->integer('age_')->nullable();
             
            $table->string('dob')->nullable();
             
            $table->string('date')->nullable();
             
            $table->string('country')->nullable();
             
            $table->string('end_date')->nullable();
                        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_01j0404dwewzmnx0gdwrvn30bm');
    }
};
