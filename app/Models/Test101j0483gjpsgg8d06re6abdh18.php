<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class Test101j0483gjpsgg8d06re6abdh18 extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'Test_1_01j0483gjpsgg8d06re6abdh18';

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
