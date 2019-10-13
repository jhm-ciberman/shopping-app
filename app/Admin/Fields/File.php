<?php

namespace App\Admin\Fields;

use Spatie\MediaLibrary\HasMedia\HasMedia;

class File extends Field
{
    protected $view = 'file';

    public function fill($request, $model)
    {
        if ($model instanceof HasMedia) {
            $file = $request->file($this->attribute);
            $model->addMedia($file)->toMediaCollection();
        }
    }

    public function resolve($model, $attribute = null)
    {
        return $model->mediumImage();
    }
}
