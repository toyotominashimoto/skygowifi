<?php

namespace App\Domains\Address\DTO\AddressDTO;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'city_id'=>'required|integer',
            'text'=>'required|string',
            'hours_of_operations'=>'nullable|integer'
        ];
    }
}
