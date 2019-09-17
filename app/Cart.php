<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Product;
use Configuration;
use Illuminate\Support\Facades\Hash;

class Cart extends Model
{
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'items',
    ];

    /**
     * The cart items
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('App\CartItem');
    }

    /**
     * The cart's user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Add a product to the cart
     *
     * @param  $product
     * @param  $quantity
     */
    public function add(Product $product, $quantity = 1)
    {
        if (!$this->exists) {
            $this->save();
        }

        return $this->items()->updateOrCreate(
            ['product_id' => $product->id],
            ['quantity'   => $quantity]
        );
    }

    public function addMany($items)
    {
        if (! $this->exists) {
            $this->save();
        }

        $items = collect($items)->reject(function($item) {
            return $this->hasProductId($item->product_id);
        });

        $this->items()->createMany($items);
    }

    /**
     * Find the product inside the cart
     *
     * @param  App\Product  $product
     * @return App\CartItem
     */
    public function findItem(Product $product)
    {
        if (!$this->exists) {
            return null;
        }

        return $this->items()->where('product_id', $product->id)->first();
    }

    /**
     * Find the product inside the cart
     *
     * @param  App\Product|App\CartItem  $productOrItem
     * @return App\CartItem
     */
    public function remove($productOrItem)
    {
        if (!$this->exists) {
            return null;
        }

        if ($productOrItem instanceof \App\Product) {
            return $this->items()->where('product_id', $productOrItem->id)->delete();
        } else if ($productOrItem instanceof \App\CartItem) {
            return $this->items()->where('id', $productOrItem->id)->delete();
        }
    }

    /**
     * Total price for all the items in the cart item without discount
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->items->sum('total');
    }

    /**
     * Total price for all the items in the cart item with discount
     *
     * @return float
     */
    public function getDiscountedTotalAttribute()
    {
        return $this->items->sum('discounted_total');
    }

    /**
     * Total price for all the items in the cart item with discount
     *
     * @return float
     */
    public function getDiscountAttribute()
    {
        return $this->items->sum('discount');
    }


    /**
     * Returns if the cart is anonymous
     *
     * @return  bool
     */
    public function isAnonymous()
    {
        return ($this->user_id === null);
    }

    /**
     * Returns if the cart is empty
     *
     * @return  bool
     */
    public function isEmpty()
    {
        return ($this->items->count() === 0);
    }

    /**
     * Returns if the cart is not empty
     *
     * @return  bool
     */
    public function isNotEmpty()
    {
        return !$this->isEmpty();
    }

    /**
     * Returns if the cart reaches the minimum amount
     *
     * @return  bool
     */
    public function reachesMinimumAmount()
    {
        return $this->discounted_total >= static::getMinimumAmount();
    }

    /**
     * Returns the minimum cash amount needed to create an order from this cart
     *
     * @return float
     */
    public static function getMinimumAmount()
    {
        return Configuration::get('CART_MIN', 0);
    }

    public function hasProduct(Product $product)
    {
        return $this->items->contains('product_id', $product->id);
    }

    public function hasProductId($id)
    {
        return $this->items->contains('product_id', $id);
    }

    public function scopeWithTrashedProducts($query)
    {
        return $query->with(['items' => function($query) {
            return $query->withTrashedProduct();
        }]);
    }

    public function getChecksumString()
    {
        return $this->toJson();
    }

    public function checksum()
    {
        return Hash::make($this->getChecksumString());
    }

    public function checkChecksum($checksum)
    {
        return Hash::check($this->getChecksumString(), $checksum);
    }

    public function toOrder()
    {
        return [
            'user_id' => $this->user_id,
        ];
    }
}
