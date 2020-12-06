<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   protected $fillable = [
        'name', 'email', 'address','salary','photo','nid','joining_date'
    ];
}
