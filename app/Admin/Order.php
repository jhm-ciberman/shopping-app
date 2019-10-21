<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Date;
use App\Admin\Core\Resource;
use App\Admin\Fields\HasMany;
use App\Admin\Fields\Money;

class Order extends Resource
{
    public static $model = 'App\Order';

    public $title = 'id';

    public $canCreate = false;

    public function fields()
    {
        return [
            ID::make(),
            Money::make('Total', 'total')->exceptOnForms(),
            Date::make('Created at', 'created_at')->exceptOnForms(),

            HasMany::make('Items', 'items', 'App\Admin\OrderItem'),
            HasMany::make('User', 'user', 'App\Admin\User'),
        ];
    }
}
