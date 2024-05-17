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
        Schema::create('new_collection', function (Blueprint $table) {
            $table->ulid('id')->primary();
             
            $table->LongText('name');
             
            $table->integer('index');
             
            $table->LongText('date');
                        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_collection');
    }
};
