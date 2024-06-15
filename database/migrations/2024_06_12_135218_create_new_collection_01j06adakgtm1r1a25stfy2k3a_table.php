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
        Schema::create('new_collection_01j06adakgtm1r1a25stfy2k3a', function (Blueprint $table) {
            $table->ulid('id')->primary();
             
            $table->string('segment')->nullable();
             
            $table->string('country')->nullable();
             
            $table->string('product')->nullable();
             
            $table->string('discount_band')->nullable();
             
            $table->double('units_sold')->nullable();
             
            $table->integer('manufacturing_price')->nullable();
             
            $table->integer('sale_price')->nullable();
             
            $table->bigInteger('gross_sales')->nullable();
             
            $table->integer('discounts')->nullable();
             
            $table->bigInteger('_sales')->nullable();
             
            $table->bigInteger('cogs')->nullable();
             
            $table->bigInteger('profit')->nullable();
             
            $table->string('date')->nullable();
             
            $table->integer('month_number')->nullable();
             
            $table->string('month_name')->nullable();
             
            $table->integer('year')->nullable();
                        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_collection_01j06adakgtm1r1a25stfy2k3a');
    }
};
