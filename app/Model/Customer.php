<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'phone', 'email','address','image'
    ];
}
