<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Services\Interfaces\IHome;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    private IHome $service;


    public function __construct(IHome $service)
    {
        $this->service = $service;
    }

    public function index(): View
    {
        return view('pages.input');
    }


    public function store(StorePostRequest $request): View
    {
        $companySymbol = $request->get('company_symbol');
        $startDate     = strtotime($request->get('start_date'));
        $endDate       = strtotime('+1 day', strtotime($request->get('end_date')));
        $company       = $this->service->findCompanyBySymbol($companySymbol);
        $data          = $this->service->getRapidFinancialApi($companySymbol);
        $dataFiltered  = $this->service->filterDataWithStartEndDate($data, $startDate, $endDate)
            ->toArray();
        $chartPoints   = $this->service->getChartDataPoints($dataFiltered);

        return view('pages.table-xm')
            ->with(['data' => $dataFiltered])
            ->with(compact('chartPoints'))
            ->with(compact('company'));
    }
}
