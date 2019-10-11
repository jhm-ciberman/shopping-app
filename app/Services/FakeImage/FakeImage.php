<?php

namespace App\Services\FakeImage;
use App\Product;
use Illuminate\Support\Facades\Storage;

class FakeImage
{

    /**
     * The file name
     *
     * @var string
     */
    private $filename;

    /**
     * The disk name
     *
     * @var string
     */
    private $disk;

    public function __construct(String $filename, $disk = 'local')
    {
        $this->filename = $filename;
        $this->disk = $disk;
    }

    public function download($force = false)
    {
        if (!$force && $this->exists()) {
            return;
        }

        retry(5, function () {
            $contents = file_get_contents($this->imageUrl());

            throw_unless($contents, \Exception::class, 'The image download failed');

            Storage::disk($this->disk)->put($this->filename, $contents);

        }, 100);
    }

    /**
     * Returns if the image exists
     *
     * @return bool
     */
    public function exists()
    {
        return Storage::disk($this->disk)->exists($this->filename);
    }

    /**
     * Returns the image path
     *
     * @return string
     */
    public function getPath()
    {
        $this->download();

        return Storage::disk($this->disk)->path($this->filename) ;
    }

    protected function imageUrl()
    {
        return 'https://picsum.photos/1080/1080/?random';
    }

}
