<?php

namespace App\Admin;

use App\Product;
use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Fields\Textarea;

class ProductResource extends Resource
{
    public $viewName = 'products';

    public $model = Product::class;

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
        ];
    }

}
