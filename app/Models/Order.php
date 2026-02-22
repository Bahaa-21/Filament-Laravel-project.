<?php

namespace App\Models;

use App\Enum\OrderStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        'status' => OrderStatusEnum::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_Id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
