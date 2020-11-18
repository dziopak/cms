<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use WebPConvert\WebPConvert;
use Spatie\ImageOptimizer\OptimizerChainFactory;
use App\Jobs\OptimizeImage;

class OptimizeImages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;

    private $allowed_extensions = [
        'jpg',
        'png'
    ];

    private $disabled_mime = [
        'image/gif'
    ];


    public function __construct($file)
    {
        $this->file = $file;
    }


    public function handle()
    {
        $extension = pathinfo($this->file)['extension'] ?? 'webp';
        $mime = mime_content_type($this->file);

        if (!empty($extension) && !empty($mime)) {
            if (in_array($extension, $this->allowed_extensions) && !in_array($mime, $this->disabled_mime)) {
                dispatch(new OptimizeImage($this->file));
            }
        }
    }
}
