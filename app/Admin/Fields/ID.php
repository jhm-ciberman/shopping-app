<?php

namespace App\Admin\Fields;

class ID extends Text
{
    public function __construct($name = null, $attribute = null)
    {
        parent::__construct($name ?? 'ID', $attribute);

        $this->exceptOnForms();
    }
}
