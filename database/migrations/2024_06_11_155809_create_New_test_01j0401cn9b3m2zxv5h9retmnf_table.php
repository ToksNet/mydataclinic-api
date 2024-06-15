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
        Schema::create('New_test_01j0401cn9b3m2zxv5h9retmnf', function (Blueprint $table) {
            $table->ulid('id')->primary();
             
            $table->string('first_name')->nullable();
             
            $table->string('last_name')->nullable();
             
            $table->integer('bankcode')->nullable();
             
            $table->bigInteger('account_number')->nullable();
             
            $table->bigInteger('amount')->nullable();
             
            $table->string('remark')->nullable();
                        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('New_test_01j0401cn9b3m2zxv5h9retmnf');
    }
};
