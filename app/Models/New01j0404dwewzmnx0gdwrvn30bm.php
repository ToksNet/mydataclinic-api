<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class New01j0404dwewzmnx0gdwrvn30bm extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'new_01j0404dwewzmnx0gdwrvn30bm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
                'name',
                'age_',
                'dob',
                'date',
                'country',
                'end_date',
            ];

   
}
