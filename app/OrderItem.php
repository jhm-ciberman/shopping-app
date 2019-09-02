<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPrice;
use App\Services\ReadableUnit;
use App\CartItem;

class OrderItem extends Model
{
    use HasPrice;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 
        'quantity',
        'price',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'product',
    ];

    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = [
        'delivered_quantity' => null,
    ];


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'price'         => 'decimal:2',
        'discount'      => 'decimal:2',
        'quantity'      => 'decimal:2',
        'delivered_quantity' => 'decimal:2',
    ];

    /**
     * Creates an OrderItem from a CartItem
     * 
     * @return  App\OrderItem
     */
    public static function fromCartItem(CartItem $cartItem)
    {
        return $cartItem->toOrderItem();
    }

    /**
     * The associated order
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() 
    {
        return $this->belongsTo('App\Order');
    }

    /**
     * The associated product
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() 
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }
    
    /**
     * Total price for all the items in the order item without discount
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Total price for all the items in the order item with discount
     *
     * @return float
     */
    public function getDiscountedTotalAttribute()
    {
        return $this->discounted_price * $this->quantity;
    }

    /**
     * Total discount for all the items in the order
     *
     * @return float
     */
    public function getTotalDiscountAttribute()
    {
        return $this->discount * $this->quantity;
    }

    /**
     * Delivered Total price for all the items in the order item without discount
     *
     * @return float
     */
    public function getDeliveredTotalAttribute()
    {
        return $this->price * $this->delivered_quantity;
    }

    /**
     * Delivered Total price for all the items in the order item without discount
     *
     * @return float
     */
    public function getDeliveredQuantityAttribute($value)
    {
        return $value ?? $this->quantity;
    }

    /**
     * Gets the  Delivered Quantity in the order item
     *
     * @return float
     */
    public function getRealDeliveredQuantityAttribute()
    {
        return $this->attributes['delivered_quantity'];
    }

    /**
     * Sets the Delivered Quantity in the order item
     *
     * @return float
     */
    public function setRealDeliveredQuantityAttribute($value)
    {
        $this->attributes['delivered_quantity'] = $value;
    }

    /**
     * Delivered Total price for all the items in the order item with discount
     *
     * @return float
     */
    public function getDeliveredDiscountedTotalAttribute()
    {
        return $this->discounted_price * $this->delivered_quantity;
    }

    /**
     * Delivered Total discount for all the items in the order
     *
     * @return float
     */
    public function getDeliveredTotalDiscountAttribute()
    {
        return $this->discount * $this->delivered_quantity;
    }

    /**
     * Returns if the order item has a discount
     *
     * @return bool
     */
    public function getHasDiscountAttribute()
    {
        return ($this->discount != 0);
    }

    /**
     * Get a readable title for the order
     *
     * @return float
     */
    public function getTitleAttribute()
    {
        return implode(' ', [
            ReadableUnit::quantity($this->quantity),
            ReadableUnit::short($this->product->unit_type), 
            $this->product->name
        ]);
    }

    public function scopeWithTrashedProduct($query)
    {
        return $query->with(['product' => function($query) {
            return $query->withTrashed();
        }]);
    }

    /**
     * Returns true if the product is invalid or null
     * 
     * @return bool
     */
    public function invalidProduct()
    {
        return ($this->product === null) || ($this->product->trashed());
    }

    public function toCartItem() 
    {
        return [
            'product_id' => $this->product_id,
            'quantity'   => $this->quantity,
        ];
    }
}
