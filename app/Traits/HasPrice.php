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
        return $this->asDecimal($this->price - $this->discount, 2);
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
