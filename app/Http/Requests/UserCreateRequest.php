<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'first_name' => ['required', 'max: 70'],
            'last_name'  => ['required', 'max: 70'],
            'email'      => ['required', 'max: 70'],
            'user_name'  => ['required', 'max: 100'],
            'mobile'     => ['required', 'max: 15'],
            'password'   => ['required', 'confirmed', 'min:8'],
            'birth_date' => ['date'],
            'gender'     => ['required'],
            'country_id' => ['nullable'],
            'city_id'    => ['required_if:country_id,!null'],
            'address'    => ['required'],
            'role'       => ['required'],
        ];
    }
}
