<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'cost',
        'price',
        'stock_quantity',
        'published',
        'category_id',
        'store_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'cost' => 'float',
        'price' => 'float',
        'published' => 'boolean',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function media(): HasMany
    {
        return $this->hasMany(Media::class);
    }

    public function publish()
    {
        $this->published = true;
        $this->save();
    }
}
