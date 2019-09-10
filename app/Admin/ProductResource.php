<?php

namespace App\Admin;

use App\Product;

class ProductResource extends Resource
{
    protected $viewName = 'products';

    public function columns() 
    {
        return [
            'id'    => 'Id',
            'name'  => 'Name',
            'description' => 'Description',
        ];
    }

    public function createIndexQuery() 
    {
        return Product::query();
    }

}