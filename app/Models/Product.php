<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
    ];
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name);
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name);
        });
    }
}
