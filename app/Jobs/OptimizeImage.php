<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use WebPConvert\WebPConvert;
use Spatie\ImageOptimizer\OptimizerChainFactory;

class OptimizeImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    public function handle()
    {
        $optimizerChain = OptimizerChainFactory::create();
        $optimizerChain->optimize($this->file);
        WebPConvert::convert($this->file, $this->file . '.webp', []);
    }
}
