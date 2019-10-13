<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasPrice;
use App\Services\ReadableUnit;

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

    protected $appends = [
        'title'
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
            'x',
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
