<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class Test1801j0401cn9b3m2zxv5h9retmnf extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'Test_18_01j0401cn9b3m2zxv5h9retmnf';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
                'first_name',
                'last_name',
                'bankcode',
                'account_number',
                'amount',
                'remark',
            ];

   
}
