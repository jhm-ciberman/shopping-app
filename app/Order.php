<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;
use App\Address;
use App\ShippingPeriod;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'shipping_starting_at',
        'shipping_ending_at'
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = null;

    /**
     * Creates a new Order from the passed Cart instance
     * 
     * @param  App\Cart  $cart
     * @param  App\Address  $shippingAddress 
     * @param  App\ShippingPeriod  $shippingPeriod 
     * @return  App\Order
     * @throws  App\Exceptions\EmptyCartException
     * @throws  App\Exceptions\AnonymousCartException
     */
    public static function fromCart(Cart $cart, Address $shippingAddress, ?ShippingPeriod $shippingPeriod = null)
    {
        return $cart->toOrder($shippingAddress, $shippingPeriod);
    }

    /**
     * The Order items
     * 
     * @var Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items() 
    {
        return $this->hasMany('App\OrderItem');
    }

    /**
     * The Order user
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The Shipping period (if exists)
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shippingPeriod() 
    {
        return $this->belongsTo('App\ShippingPeriod')->withTrashed();
    }

    /**
     * The reports that belong to the order.
     * 
     * @var Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reports()
    {
        return $this->belongsToMany('App\ShippingReport', 'order_shipping_report', 'order_id', 'shipping_id');
    }

    /**
     * Returns the url for printing this order
     * 
     * @var string
     */
    public function getPrintingUrlAttribute() 
    {
        return route('pdf.order.printing', $this);
    }

    /**
     * Returns the url for printing this order
     * 
     * @var string
     */
    public function getMailUrlAttribute() 
    {
        return route('pdf.order', $this);
    }

    /**
     * Get the attached addresses to the order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address()
    {
        return $this->belongsTo('App\Address', 'address_id');
    }

    /**
     * Total price for all the items in the order without discount
     *
     * @return float
     */
    public function getTotalAttribute()
    {
        return $this->items->sum('total');
    }

    /**
     * Total price for all the items in the order wtth discount
     *
     * @return float
     */
    public function getDiscountedTotalAttribute()
    {
        return $this->items->sum('discounted_total');
    }

    /**
     * Delivered Total price for all the items in the order without discount
     *
     * @return float
     */
    public function getDeliveredTotalAttribute()
    {
        return $this->items->sum('delivered_total');
    }

    /**
     * Delivered Total price for all the items in the order wtth discount
     *
     * @return float
     */
    public function getDeliveredDiscountedTotalAttribute()
    {
        return $this->items->sum('delivered_discounted_total');
    }

    /**
     * Get a readable title for the order
     *
     * @return float
     */
    public function getTitleAttribute()
    {
        return $this->items->pluck('title')->implode(' + ');
    }

    public function scopeWithTrashedProducts($query)
    {
        return $query->with(['items' => function($query) {
            return $query->withTrashedProduct();
        }]);
    }

    /**
     * Add all the items from the specified cart
     * 
     * @return void
     */
    public function addItemsFromCart(Cart $cart)
    {
        $this->items()->saveMany(
            $cart->items
                ->map->toOrderItem()
        );
    }

}
