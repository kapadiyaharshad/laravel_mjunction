<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        // Let's get the route param by name to get the User object value
        $user = request()->route('user');

        return [
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'role_id' => 'required',
            'designation_id' => 'required',
            'account_type_id' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'business_unit_id' => 'required'
        ];
    }
}
