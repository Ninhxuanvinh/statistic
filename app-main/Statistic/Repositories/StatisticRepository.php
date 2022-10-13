<?php

namespace AppMain\Statistic\Repositories;

use AppMain\Statistic\Models\Site;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StatisticRepository
{
    private $model;
    public function __construct(Site $site)
    {
        $this->model = $site;
    }

    public function getAll()
    {
        return Site::all();
    }

    public function getSite($site){
        $info = Site::where('sites_name',$site)->get(['sites_name','date','jobs_all','jobs_public','jobs_duplicated']);
        return $info;
    }

    public function store($arr)
    {
        DB::beginTransaction();
        try {
            Site::create($arr);
            DB::commit();
        }catch (Exception $e)
        {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
    }

    public function getId($name, $date)
    {
        $info = Site::where('sites_name',$name)
            ->whereDate('date',$date)
            ->get();
        return $info[0]->id;
    }

    public function update($id,$arr)
    {
        $result = $this->model->findOrFail($id);
        $result->update($arr);
        Log::info($result);
    }

    public function checkExist($site, $date)
    {
        return Site::where('sites_name',$site)
                ->whereDate('date', $date)
                ->exists();
    }

}
