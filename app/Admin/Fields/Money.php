<?php

namespace App\Admin\Fields;

class Money extends Text
{
    public function resolve($model, $attribute = null)
    {
        $number = parent::resolve($model, $attribute);

        return $number ? '$ ' . number_format($number, 2) : $number;
    }
}
