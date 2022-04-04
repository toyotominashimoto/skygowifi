<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAffiliateRequest extends FormRequest
{
    /**
     * Determine if the Affiliate is authorized to make this request.
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
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'email' => 'nullable|string',
            'password'=>['nullable','string',Password::min(8)->letters()->mixedCase()->numbers()],
        ];
    }
    public function messages (){
        return [
            'first_name.required'=>'name needed',
            'email.required'=>'required email',
            'password.letters'=>'password must contain letters ',
            'password.numbers'=>'password must have numbers also',
            'password.mixedCase'=>'password must have at least 1 lowercase and uppercase letter'
        ];
    }    
}
