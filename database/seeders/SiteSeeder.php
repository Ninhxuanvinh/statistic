<?php

namespace Database\Seeders;

use AppMain\Statistic\Models\Site;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Exception
     */
    public function run()
    {
        $inputArray = ['site1','site2','site3','site4','site5'];
        $faker = Factory::create();

        for($i = 1;$i < 15; $i++){
            $jobs_all = random_int(10,100);
            $jobs_public = random_int(1,$jobs_all);
            $jobs_duplicated = $jobs_all - $jobs_public;
            DB::table('sites')->insert([
                'sites_name' => Arr::random($inputArray),
                'date' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = '2022-9-30'),
                'jobs_all' => $jobs_all,
                'jobs_public' => $jobs_public,
                'jobs_duplicated' => $jobs_duplicated,
            ]);
        }

    }
}
