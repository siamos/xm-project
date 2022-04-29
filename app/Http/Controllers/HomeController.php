<?php

namespace App\Http\Controllers;

use App\Http\Dto\GetDto;
use App\Http\Requests\StorePostRequest;
use App\Http\Services\Interfaces\IHome;
use App\Http\Services\Interfaces\IMail;
use Illuminate\View\View;

class HomeController extends Controller
{
    private IHome $service;
    private IMail $mailService;


    public function __construct(IHome $service, IMail $mailService)
    {
        $this->service     = $service;
        $this->mailService = $mailService;
    }

    public function index(): View
    {
        return view('pages.input');
    }


    public function store(StorePostRequest $request): View
    {
        $getDto = new GetDto(
            $request->get('company_symbol'),
            $request->get('email'),
            $request->get('start_date'),
            $request->get('end_date')
        );

        $company      = $this->service->findCompanyBySymbol($getDto->getSymbol());
        $data         = $this->service->getRapidFinancialApi($getDto->getSymbol());
        $dataFiltered = $this->service->filterDataWithStartEndDate(
            $data,
            $getDto->getStartDateStrTime(),
            $getDto->getEndDateStrTime()
        )->toArray();

        $chartPoints  = $this->service->getChartDataPoints($dataFiltered);

        $this->mailService->dispatchEmail($company, $getDto);

        return view('pages.table-xm')
            ->with(['data' => $dataFiltered])
            ->with(compact('chartPoints'))
            ->with(compact('company'));
    }

}
