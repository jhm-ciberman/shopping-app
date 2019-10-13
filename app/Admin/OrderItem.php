<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Core\Resource;

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
            Text::make('Product ID', 'product_id')->onlyOnIndex(),
            Text::make('Created at', 'created_at')->onlyOnIndex(),
        ];
    }
}
