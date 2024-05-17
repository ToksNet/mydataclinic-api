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
        Schema::create('users', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('organisation_id');
            $table->string('collection_name');
            $table->string('collection_email')->unique();
            $table->longText('collection_description');
            $table->string('collection_slug');
            $table->string('password');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('organisation_id')
                ->references('id')
                ->on('organisations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
