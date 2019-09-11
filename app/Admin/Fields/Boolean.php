<?php

namespace App\Admin\Fields;

class Boolean extends Field
{
    public function resolve($model, $attribute = null)
    {
        return parent::resolve($model, $attribute) ? 'Yes' : 'No';
    }
}
