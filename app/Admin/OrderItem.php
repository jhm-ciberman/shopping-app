<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Date;
use App\Admin\Core\Resource;
use App\Admin\Fields\Money;

class OrderItem extends Resource
{
    public static $model = 'App\OrderItem';

    public $title = 'id';

    public $canCreate = false;

    public static $displayInNavigation = false;

    public function fields()
    {
        return [
            ID::make(),
            Money::make('Product', 'title')->exceptOnForms(),
            Money::make('Price', 'price')->exceptOnForms(),
            Money::make('Discount', 'discount')->exceptOnForms(),
            Money::make('Discounted total', 'discounted_total')->exceptOnForms(),
            Date::make('Created at', 'created_at')->exceptOnForms(),
        ];
    }
}
