<?php

namespace App\Traits;

trait HasPrice
{
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