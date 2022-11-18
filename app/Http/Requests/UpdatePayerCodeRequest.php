<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePayerCodeRequest extends FormRequest
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
        $payer_code = request()->route('payer_code');
        return [
            'payer_code' => 'required|unique:payer_codes,payer_code,'.$payer_code->id,
            'client_name' => 'required'
        ];
    }
}
