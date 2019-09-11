<?php

namespace App\Admin\Fields;

class ID extends Field
{

    public function __construct($name = null, $attribute = null)
    {
        parent::__construct($name ?? 'ID', $attribute);

        $this->exceptOnForms();
    }

    public function fieldName()
    {
        return 'text';
    }
}
