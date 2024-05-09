<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = "product_sizes";

    public $timestamps = false;

    protected $fillable = [
        "product_id",
        "size_id",

    ];

    
}
