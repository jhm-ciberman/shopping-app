<?php

namespace App\Services\FakeImage;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class FakeImageFactory
{

    /**
     * The disk name
     * 
     * @var string
     */
    public $disk;

    /**
     * The direcrory name
     * 
     * @var string
     */
    public $directory;

    public function __construct() 
    {
        $this->directory = '.';
        $this->disk = 'fakeimage';
    }

    /**
     * Return a collection of images
     * 
     * @param  int  $number  The number of images
     * @return Collection
     */
    public function make($number) 
    {
        return Collection::times($number, function ($i) {
            return new FakeImage("{$this->directory}/{$i}.jpg", $this->disk);
        });
    }

    /**
     * Remove all the fake images (destroys also the parent directory)
     */
    PUblic function deleteAll()
    {
        $disk = Storage::disk($this->disk);
        
        $disk->delete($disk->allFiles($this->directory));
    }



}