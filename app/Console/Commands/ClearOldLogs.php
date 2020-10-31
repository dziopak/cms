<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Entities\Log;

class ClearOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:clear-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears logs older than specified in settings';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = (new \DateTime)->modify('-60 days')->format('Y-m-d H:i:s');
        Log::where('created_at', '<=', $date)->delete();
    }
}
