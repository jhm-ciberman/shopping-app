<?php

namespace App\Admin;

use App\Category;
use App\Admin\Fields\ID;
use App\Admin\Fields\Text;

class CategoryResource extends Resource
{
    public $viewName = 'categories';

    public $model = Category::class;

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
        ];
    }
}
