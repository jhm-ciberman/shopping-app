<?php

namespace App\Admin;

use App\Admin\Fields\ID;
use App\Admin\Fields\Text;
use App\Admin\Core\Resource;
use App\Admin\Fields\BelongsToMany;
use App\Admin\Fields\Date;

class Category extends Resource
{
    public static $model = 'App\Category';

    public $name = "Category";

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
            Date::make('Created At', 'created_at')->exceptOnForms(),
            BelongsToMany::make('Products', 'products', 'App\Admin\Product')->onlyOnDetail(),
        ];
    }
}
