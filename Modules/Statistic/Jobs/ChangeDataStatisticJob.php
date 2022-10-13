<?php

namespace Modules\Statistic\Jobs;

use AppMain\Statistic\Serivces\StatisticService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChangeDataStatisticJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $arr;
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info($this->arr);
        $staticService = app(StatisticService::class);
        $staticService->insertOrUpdateSite($this->arr);
    }
}
