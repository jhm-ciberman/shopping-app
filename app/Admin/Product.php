<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Date;
use App\Admin\Fields\Textarea;
use App\Admin\Fields\HasMany;
use App\Admin\Core\Resource;
use App\Admin\Fields\Money;

class Product extends Resource
{
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
            Money::make('Price', 'price'),
            Money::make('Discount', 'discount'),
            Money::make('Discounted price', 'discounted_price')->exceptOnForms(),
            Date::make('Created at', 'created_at')->exceptOnForms(),
            Date::make('Updated at', 'updated_at')->exceptOnForms(),

            HasMany::make('Categories', 'categories', 'App\Admin\Category'),
        ];
    }

}
