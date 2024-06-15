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
        Schema::create('Lab_sales_01j0404dwewzmnx0gdwrvn30bm', function (Blueprint $table) {
            $table->ulid('id')->primary();
             
            $table->bigInteger('bill_id')->nullable();
             
            $table->bigInteger('patient_id')->nullable();
             
            $table->string('transaction_date')->nullable();
             
            $table->string('due_date')->nullable();
             
            $table->string('description')->nullable();
             
            $table->integer('bill_source_id')->nullable();
             
            $table->string('bill_sub_source_id')->nullable();
             
            $table->string('in_patient_id')->nullable();
             
            $table->string('transaction_type')->nullable();
             
            $table->integer('amount')->nullable();
             
            $table->integer('copay')->nullable();
             
            $table->integer('balance')->nullable();
             
            $table->string('price_type')->nullable();
             
            $table->string('discounted')->nullable();
             
            $table->string('discounted_by')->nullable();
             
            $table->string('invoiced')->nullable();
             
            $table->integer('receiver')->nullable();
             
            $table->string('auth_code')->nullable();
             
            $table->integer('reviewed')->nullable();
             
            $table->integer('transferred')->nullable();
             
            $table->integer('claimed')->nullable();
             
            $table->string('validated')->nullable();
             
            $table->string('voucher_id')->nullable();
             
            $table->integer('hospid')->nullable();
             
            $table->integer('billed_to')->nullable();
             
            $table->string('payment_method_id')->nullable();
             
            $table->string('payment_reference')->nullable();
             
            $table->string('referral_id')->nullable();
             
            $table->string('cost_centre_id')->nullable();
             
            $table->string('revenue_account_id')->nullable();
             
            $table->string('item_code')->nullable();
             
            $table->string('insurance_code')->nullable();
             
            $table->integer('quantity')->nullable();
             
            $table->integer('unit_price')->nullable();
             
            $table->string('encounter_id')->nullable();
             
            $table->string('parent_id')->nullable();
             
            $table->string('cancelled_on')->nullable();
             
            $table->string('cancelled_by')->nullable();
             
            $table->integer('misc')->nullable();
             
            $table->string('bill_active')->nullable();
                        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Lab_sales_01j0404dwewzmnx0gdwrvn30bm');
    }
};
