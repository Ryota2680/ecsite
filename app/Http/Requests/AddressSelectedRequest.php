<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressSelectedRequest extends FormRequest
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
			'selected_flg' => 'required|integer',
        ];
    }

    	public function messages()
	{
		return [
			'selected_flg.*' => 'お届け先を選択してください',
		];
	}
}
