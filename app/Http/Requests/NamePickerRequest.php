<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NamePickerRequest extends FormRequest
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
            'type' => 'required',
            'data' => ['array'],
            'data.items' => ['array', 'required_unless:type,6'],
            'data.qty' => 'required_if:type,5',
            'data.items.*' => ['string'],
            'data.result' => ['array'],
        ];
    }
}
