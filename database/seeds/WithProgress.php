<?php

use Symfony\Component\Console\Helper\ProgressBar;

trait WithProgress
{
    /**
     * Starts the progress
     *
     * @param  int  $units
     * @return \Symfony\Component\Console\Helper\ProgressBar
     */
    public function progress($units)
    {
        $progress = new ProgressBar($this->command->getOutput(), 50);
        $progress->start();
        return $progress;
    }
}
