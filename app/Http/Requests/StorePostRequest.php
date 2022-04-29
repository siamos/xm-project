<?php

namespace App\Http\Requests;

use App\Http\Services\HomeService;
use App\Rules\CheckSymbol;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    private CheckSymbol $checkSymbol;

    public function __construct(CheckSymbol $checkSymbol)
    {
        parent::__construct();
        $this->checkSymbol = $checkSymbol;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'company_symbol' => ['required',
                                 'max:6',
                                 'regex:/[A-Z\s]+/', $this->checkSymbol],
            'email'          => ['required', 'email'],
            'start_date'     => ['required', 'date', 'before_or_equal:end_date', 'before_or_equal:today'],
            'end_date'       => ['required', 'date', 'after_or_equal:start_date', 'before_or_equal:today']
        ];
    }

    public function messages(): array
    {
        return [
            'company_symbol.regex' => 'The company symbol format is invalid. Must be in capitalise letters'
        ];
    }
}
