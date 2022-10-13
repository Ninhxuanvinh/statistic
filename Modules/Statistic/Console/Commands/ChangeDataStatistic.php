<?php

namespace Modules\Statistic\Console\Commands;

use AppMain\Statistic\Serivces\StatisticService;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Modules\Statistic\Jobs\ChangeDataStatisticJob;

class ChangeDataStatistic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'random:statistic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     * @throws \Exception
     */
    public function handle()
    {
        $faker = Factory::create();
        $sitesArray = ['site1','site2','site3','site4','site5'];
        $jobs_all = random_int(10,100);
        $jobs_public = random_int(1,$jobs_all);
        $jobs_duplicated = $jobs_all - $jobs_public;
        $arr = [
            'sites_name' => Arr::random($sitesArray),
            'date' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = '2022-9-30'),
            'jobs_all' => $jobs_all,
            'jobs_public' => $jobs_public,
            'jobs_duplicated' => $jobs_duplicated
        ];
        ChangeDataStatisticJob::dispatch($arr)->onQueue('changeDataSite');
    }
}
