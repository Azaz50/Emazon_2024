<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductColor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";


    protected $fillable = [
        "code",
        "title",
        "subtitle",
        "description",
        "price_mp",
        "price_sp",
        "category_id",
        "slug",
        "image_url",
        

    ];

    public function markedPrice()
    {
        return $this->price_mp;
    }

    public function productColors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }

    public function productSizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    
}
