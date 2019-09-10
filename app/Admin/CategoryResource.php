<?php

namespace App\Admin;

use App\Category;

class CategoryResource extends Resource
{
    protected $viewName = 'categories';
    
    public function columns() 
    {
        return [
            'id'    => 'Id',
            'name'  => 'Name',
        ];
    }

    public function createIndexQuery() 
    {
        return Category::query();
    }
}