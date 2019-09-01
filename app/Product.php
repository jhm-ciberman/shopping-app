<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasNameSlug;

class Product extends Model
{
    use HasNameSlug;
    
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price'              => 'decimal:2',
        'discount'           => 'decimal:2',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // static::deleting(function($product) {
        //     CartItem::where('product_id', $product->id)->delete();
        // });
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

    /**
     * Final discounted price
     *
     * @return float
     */
    public function getDiscountedPriceAttribute()
    {
        return  $this->price - $this->discount;
    }

    /**
     * Returns if the product has a discount
     *
     * @return bool
     */
    public function getHasDiscountAttribute()
    {
        return ($this->discount != 0);
    }
}
