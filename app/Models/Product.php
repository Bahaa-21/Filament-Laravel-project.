<?php

namespace App\Models;

use App\Enum\ProductStatusEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'status', 'category_Id', 'sku', 'slug', 'quantity', 'image', 'is_visible', 'is_featured', 'published_at'];

    protected $casts = [
        'status' => ProductStatusEnum::class,
        'is_visible' => 'boolean',
        'is_featured' => 'boolean'
    ];

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value,
            set: fn($value) => $value,
        );
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
