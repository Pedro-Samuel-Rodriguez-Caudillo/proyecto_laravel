<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    var Name;
    //
    public $fillable = [
        'Name',
        'Description',
        'DescriptionLong',
        'Price',
    ];

}
