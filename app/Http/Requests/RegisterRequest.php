<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email'       => 'required|email|unique:users,email',
            'password'    => ['required', 'min:6', function($attribute, $value, $fail) {
                $pattern = '/^(?=.*[0-9])(?=.*[a-zA-Z]).{6,}$/';
                if (!preg_match($pattern, $value)) {
                    $fail('Password must be at least 6 characters and must contain both numbers and letters.');
                }
            }],
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'institution' => 'required|string',
            'department'  => 'required|string',
            'keywords'    => 'required|string',
        ];
    }
}
