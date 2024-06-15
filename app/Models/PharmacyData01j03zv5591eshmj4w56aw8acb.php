<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class PharmacyData01j03zv5591eshmj4w56aw8acb extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'pharmacy_Data_01j03zv5591eshmj4w56aw8acb';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
                'segment',
                'country',
                'product',
                'discount_band',
                'units_sold',
                'manufacturing_price',
                'sale_price',
                'gross_sales',
                'discounts',
                'sales',
                'cogs',
                'profit',
                'date',
                'month_number',
                'month_name',
                'year',
            ];

   
}
