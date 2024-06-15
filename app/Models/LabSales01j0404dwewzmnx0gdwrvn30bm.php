<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class LabSales01j0404dwewzmnx0gdwrvn30bm extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'Lab_sales_01j0404dwewzmnx0gdwrvn30bm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
                'bill_id',
                'patient_id',
                'transaction_date',
                'due_date',
                'description',
                'bill_source_id',
                'bill_sub_source_id',
                'in_patient_id',
                'transaction_type',
                'amount',
                'copay',
                'balance',
                'price_type',
                'discounted',
                'discounted_by',
                'invoiced',
                'receiver',
                'auth_code',
                'reviewed',
                'transferred',
                'claimed',
                'validated',
                'voucher_id',
                'hospid',
                'billed_to',
                'payment_method_id',
                'payment_reference',
                'referral_id',
                'cost_centre_id',
                'revenue_account_id',
                'item_code',
                'insurance_code',
                'quantity',
                'unit_price',
                'encounter_id',
                'parent_id',
                'cancelled_on',
                'cancelled_by',
                'misc',
                'bill_active',
            ];

   
}
