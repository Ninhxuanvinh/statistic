<?php

namespace AppMain\Statistic\Serivces;

use AppMain\Statistic\Repositories\StatisticRepository;
use Illuminate\Support\Facades\Log;

class StatisticService
{
    private $statisticRepository;

    public function __construct(StatisticRepository $statisticRepository)
    {
        $this->statisticRepository = $statisticRepository;
    }

    public function insertOrUpdateSite($arr): void
    {
        $date = explode(" ",$arr['date']->date);
        $checkExist = $this->statisticRepository->checkExist($arr['sites_name'],$date[0]);
        if($checkExist){
            $id = $this->statisticRepository->getId($arr['sites_name'], $date[0]);
            $this->statisticRepository->update($id, $arr);
        }else{
            $this->statisticRepository->store($arr);
        }
    }

    public function getSite($site)
    {
        return $this->statisticRepository->getSite($site);
    }

    public function getAll()
    {
        return $this->statisticRepository->getAll();
    }

}
