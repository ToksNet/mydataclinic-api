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
        Schema::create('collection_2', function (Blueprint $table) {
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
        Schema::dropIfExists('collection_2');
    }
};
