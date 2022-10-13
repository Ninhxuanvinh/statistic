<?php

namespace Modules\Statistic\Http\Controllers;

use AppMain\Statistic\Serivces\StatisticService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatisticController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    private $statisticService;
    public function __construct(StatisticService $statisticService)
    {
     $this->statisticService = $statisticService;
    }

    public function index()
    {
        $data = $this->statisticService->getAll();
        return view('statistic::index')->with(['dataSite' => $data]);
    }

    public function getSite($site)
    {
       $data = $this->statisticService->getSite($site);
       return view('statistic::index')->with([
           'dataSite' => $data,
            ]);
    }

}
