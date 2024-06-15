<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class NewCollection01j06adakgtm1r1a25stfy2k3a extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'new_collection_01j06adakgtm1r1a25stfy2k3a';

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
                '_sales',
                'cogs',
                'profit',
                'date',
                'month_number',
                'month_name',
                'year',
            ];

   
}
