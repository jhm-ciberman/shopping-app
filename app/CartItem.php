<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 
        'quantity',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'product',
    ];

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
    protected $touches = ['cart'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'quantity'      => 'decimal:2',
    ];

    /**
     * The associated cart
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cart() 
    {
        return $this->belongsTo('App\Cart');
    }

    /**
     * The associated product
     * 
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() 
    {
        return $this->belongsTo('App\Product');
    }

    /**
     * Total price for all the items in the cart item without discount
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->product->price * $this->quantity;
    }

    /**
     * Total price for all the items in the cart item without discount
     *
     * @return float
     */
    public function getDiscountAttribute()
    {
        return $this->product->discount * $this->quantity;
    }

    /**
     * Total price for all the items in the cart item with discount
     *
     * @return float
     */
    public function getDiscountedTotalAttribute()
    {
        return $this->product->discounted_price * $this->quantity;
    }

    /**
     * Returns if the order item has a discount
     *
     * @return bool
     */
    public function getHasDiscountAttribute()
    {
        return ($this->discount_total != 0);
    }

    /**
     * Creates an OrderItem from the current CartItem
     * 
     * @return  App\OrderItem
     */
    public function toOrderItem()
    {
        // return OrderItem::make([
        //     'price'      => $this->product->price,
        //     'discount'   => $this->product->discount,
        //     'product_id' => $this->product_id,
        //     'quantity'   => $this->quantity,
        // ]);
    }
}
