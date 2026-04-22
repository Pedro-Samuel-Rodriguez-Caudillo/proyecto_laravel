<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    //
    protected $fillable = [
        'Name',
        'Description',
        'DescriptionLong',
        'Price',
    ];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

}
