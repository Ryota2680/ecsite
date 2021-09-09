<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Address;

class AddressRequest extends FormRequest
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
			'name' => 'required|string|max:20',
			'zip' => 'required|digits:7',
			'pref' => 'required|string|max:4',
			'city' => 'required',
			'detail_address' => 'required',
			'phone_num' => 'required|digits_between:10,11',
			'selected_flg' => 'boolean',
        ];
	}

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $auth = Auth::user();
            $addresses = Address::where('user_id', $auth->id)->get();

            $name = $this->request->get('name');
            $zip = $this->request->get('zip');
            $pref = $this->request->get('pref');
            $city = $this->request->get('city');
            $detail_address = $this->request->get('detail_address');
            $phone_num = $this->request->get('phone_num');

            foreach ( $addresses as $address ) {
                if ($address->name == $name &&
                    $address->zip == $zip &&
                    $address->pref == $pref &&
                    $address->city == $city &&
                    $address->detail_address == $detail_address &&
                    $address->phone_num == $phone_num
                    ) {
                    $validator->errors()->add('added', 'その住所は既に登録されています');
                }
            }
        });
  }


	public function messages()
	{
		return [
			'name.required' => '名前を入力してください',
			'zip.required' => '郵便番号を入力してください',
			'zip.digits' => '正しい郵便番号を入力してください',
			'pref' => '正しい都道県名を入力してください',
			'city.required' => '市町村を入力してください',
			'detail_address.required' => '番地を入力してください',
			'phone_num.*' => '正しい電話番号を入力してください',
			'selected_flg.*' => 'お届け先を選択してください',
		];
	}
}
