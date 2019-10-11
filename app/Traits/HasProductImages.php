<?php

namespace App\Traits;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\Image\Manipulations;

trait HasProductImages
{
    use HasMediaTrait;

    /**
     * Register the media convertions
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
                ->crop(Manipulations::CROP_CENTER, 64, 64)
                ->nonQueued();

        $this->addMediaConversion('small')
                ->crop(Manipulations::CROP_CENTER, 183, 137)
                ->nonQueued();

        $this->addMediaConversion('medium')
                ->crop(Manipulations::CROP_CENTER, 430, 300)
                ->nonQueued();

        $this->addMediaConversion('carousel')
                ->crop(Manipulations::CROP_CENTER, 1080, 400)
                ->nonQueued();
    }

    protected function getMediaAtIndex($conversion, $index = 0)
    {
        return optional($this->getMedia()->get($index))->getUrl($conversion);
    }

    public function thumbImage($index = 0)
    {
        return $this->getMediaAtIndex('thumb', $index);
    }

    public function mediumImage($index = 0)
    {
        return $this->getMediaAtIndex('medium', $index);
    }

    public function smallImage($index = 0)
    {
        return $this->getMediaAtIndex('small', $index);
    }

    public function carouselImage($index = 0)
    {
        return $this->getMediaAtIndex('carousel', $index);
    }
}
