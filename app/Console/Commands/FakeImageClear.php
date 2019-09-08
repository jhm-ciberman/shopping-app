<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FakeImage\FakeImageFactory;

class FakeImageClear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fakeimage:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes all the fake images cache';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(FakeImageFactory $factory)
    {       
        $factory->deleteAll();
        $this->info('Fake Images cache cleared!');
    }

}
