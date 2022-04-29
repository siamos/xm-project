<?php
declare(strict_types=1);


namespace App\Http\Services;


use App\Http\Constants\HomeConstants;
use App\Http\Services\Interfaces\IHome;
use Illuminate\Support\Collection;

class HomeService implements IHome
{

    public function getRapidFinancialApi(string $companySymbol): string
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => "https://yh-finance.p.rapidapi.com/stock/v3/get-historical-data?symbol=$companySymbol&region=US",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => [
                "X-RapidAPI-Host: yh-finance.p.rapidapi.com",
                "X-RapidAPI-Key:" . env('RAPID_API_KEY')
            ],
        ]);

        $response = curl_exec($curl);
        $err      = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }


    public function findCompanyBySymbol(string $companySymbol): ?array
    {
        $data = json_decode(file_get_contents(HomeConstants::NASDAQ_API_URL));
        foreach ($data as $company) {
            if ($company->Symbol === $companySymbol) {
                return (array)$company;
            }
        }

        return null;
    }

    public function filterDataWithStartEndDate(string $data, int $startDate, int $endDate): Collection
    {
        $data = collect(json_decode($data)->prices);

        return $data->filter(function ($value, $key) use ($startDate, $endDate) {
            return ($value->date >= $startDate) && ($value->date <= $endDate);
        });
    }

    public function getChartDataPoints(array $dataFiltered): string
    {
        $dataPoints = [];
        foreach ($dataFiltered as $data) {
            $dataPoints[] = [
                "x" => $data->date * 1000,
                "y" => [
                    $data->open ?? null,
                    $data->high ?? null,
                    $data->low ?? null,
                    $data->close ?? null
                ]
            ];
        }

        return json_encode($dataPoints, JSON_NUMERIC_CHECK);
    }
}
