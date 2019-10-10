<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Core\Resource;
use App\Admin\Fields\HasMany;

class Order extends Resource
{
    public static $model = 'App\Order';

    public $title = 'id';

    public $canCreate = false;

    public function fields()
    {
        return [
            ID::make(),
            Text::make('User ID', 'user_id')->exceptOnForms(),
            Text::make('Created at', 'created_at')->exceptOnForms(),

            HasMany::make('Items', 'items', 'App\Admin\OrderItem'),
            HasMany::make('User', 'user', 'App\Admin\User'),
        ];
    }
}
