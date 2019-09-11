<?php

namespace App\Admin\Fields;

class Textarea extends Field
{
    public function __construct($name = null, $attribute = null)
    {
        parent::__construct($name, $attribute);

        $this->hideFromIndex();
    }
}
