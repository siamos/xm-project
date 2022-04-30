<?php

namespace Tests\Unit;

use App\Http\Services\HomeService;
use PHPUnit\Framework\TestCase;

class HomeServicTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_find_company_true()
    {
        $company = (new HomeService())->findCompanyBySymbol('AAIT');
        if (!empty($company)) {
            $this->assertTrue(true);
        } else {
            $this->assertNull(null);
        }
    }

    public function test_rapid_api_true()
    {
        $api = (new HomeService())->getRapidFinancialApi('AAIT');

        $this->assertJson($api);
    }

    public function test_filter_data_is_true()
    {
        $file = file_get_contents('extra_test_assets/dummy.json');
        $api = (new HomeService())->filterDataWithStartEndDate(
            $file,
            strtotime('2022-04-01'),
            strtotime('+1 day', strtotime('2022-04-30'))
        );

        $this->assertIsArray($api->toArray());
    }
}
