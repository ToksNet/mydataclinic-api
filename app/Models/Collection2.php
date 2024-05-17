<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

use Illuminate\Database\Eloquent\Model;

class Collection2 extends Model
{
    use HasApiTokens, HasFactory, HasUlids;


    protected $table = 'collection_2';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     
    protected $fillable = [
                'name',
                'index',
                'date',
            ];

   
}
