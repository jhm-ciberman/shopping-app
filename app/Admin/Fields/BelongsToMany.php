<?php

namespace App\Admin\Fields;

class BelongsToMany extends Relationship implements ListableField
{
    public function indexFields()
    {
        return $this->newResource()->indexFields();
    }
}
