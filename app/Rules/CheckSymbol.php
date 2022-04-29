<?php

namespace App\Rules;

use App\Http\Services\Interfaces\IHome;
use Illuminate\Contracts\Validation\Rule;

class CheckSymbol implements Rule
{
    private IHome $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(IHome $service)
    {
        $this->service = $service;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !empty($this->service->findCompanyBySymbol($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Company Doesn\'t Exist!';
    }
}
