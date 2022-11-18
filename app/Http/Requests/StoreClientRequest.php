<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
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
            'client_name' => 'required|unique:clients',
            'bu_name' => 'required',
            'service_name' => 'required',
            'category_name' => 'required',
            'business_segment' => 'required',
            'profit_center' => 'required',
            // 'payer_code' => 'required',
            'account_type' => 'required'
        ];
    }
}
