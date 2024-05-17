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
        Schema::create('organisations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('business_name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('business_email');
            $table->string('business_phone')->nullable();
            $table->string('business_industry')->nullable();
            $table->string('password');
            $table->string('business_country')->nullable();
            $table->string('business_state')->nullable();
            $table->string('business_city')->nullable();
            $table->string('business_address')->nullable();
            $table->string('business_postal_code')->nullable();
            $table->string('status')->default('active') ->nullable()->comment('inactive, active');
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organisations');
    }
};


            