<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Textarea;
use App\Admin\Fields\HasMany;
use App\Admin\Core\Resource;


class Product extends Resource
{
    public $viewName = 'products';

    public static $model = 'App\Product';

    public $name = "Product";

    public $title = 'name';

    public function createFindQuery($id)
    {
        return parent::createFindQuery($id)->orWhere('slug', $id);
    }

    public function fields()
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Textarea::make('Description', 'description'),
            Text::make('Price', 'price'),
            Text::make('Discount', 'discount'),
            Text::make('Discounted price', 'discounted_price')->exceptOnForms(),
            HasMany::make('Categories', 'categories', 'App\Admin\Category'),
        ];
    }

}
