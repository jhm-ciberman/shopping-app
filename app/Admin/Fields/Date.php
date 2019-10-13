<?php

namespace App\Admin\Fields;

class Date extends Text
{
    public function resolve($model, $attribute = null)
    {
        return optional(parent::resolve($model, $attribute))->format('d-M-Y H:i');
    }
}
