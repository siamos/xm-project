<?php
declare(strict_types=1);


namespace App\Http\Services\Interfaces;


use Illuminate\Support\Collection;

interface IHome
{
    public function getRapidFinancialApi(string $companySymbol): string;
    public function filterDataWithStartEndDate(string $data, int $startDate, int $endDate): Collection;
    public function findCompanyBySymbol(string $companySymbol): ?array;
    public function getChartDataPoints(array $dataFiltered): string;

}
