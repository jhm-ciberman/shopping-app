<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FakeImage\FakeImageFactory;

class FakeImageDownload extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fakeimage:download
                            {number=50 : The amount of images to dowload}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download Fake images to be used by the seeders';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(FakeImageFactory $factory)
    {
        $number = $this->argument('number');
        
        $bar = $this->output->createProgressBar($number);

        $factory->make($number)->each(function($image) use ($bar) {
            $image->download();

            $bar->advance();
        });

        $bar->finish();
        $this->info('Ready!');
    }

}
