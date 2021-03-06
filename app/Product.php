<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use App\Traits\HasNameSlug;
use App\Traits\HasPrice;
use App\Traits\HasProductImages;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model implements HasMedia
{
    use HasNameSlug, HasPrice, SoftDeletes, HasProductImages;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount',
    ];

    protected $appends = [
        'discounted_price'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price'              => 'decimal:2',
        'discount'           => 'decimal:2',
        'discounted_price'   => 'decimal:2',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($product) {
            CartItem::where('product_id', $product->id)->delete();
        });
    }

    /**
     * The orders that belong to the report.
     *
     * @var Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
     * The cart items for this product
     *
     * @var Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cartItems()
    {
        return $this->hasMany('App\CartItems');
    }

    /**
     * Return a query with all the related models
     */
    public function related()
    {
        return self::whereHas('categories', function ($query) {
            $query->whereIn('id', $this->categories->pluck('id'));
        });
    }

    /**
     * Get recent products
     *
     * @param  int  $amount
     */
    public static function getRecent($amount = 3)
    {
        return self::latest('updated_at')->take($amount)->get();
    }
}
