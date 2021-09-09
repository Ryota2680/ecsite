<?php

//config('common.flg.true')

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddressSelectedRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
	public function index ()
	{
		$addresses = address::where('user_id', Auth::id())->get();
		return view('address.index', compact('addresses'));
	}
	public function showAddForm ()
	{
		$prefs = config('common.pref');
		return view('address.add', compact('prefs'));
	}
	public function add (AddressRequest $request)
	{
		//バリデーション後の値
		$params = $request->validated();

		$params['user_id'] = Auth::id();
		//お届け先に選択した場合、既にお届け先に選択されている値をfalseにする
		if (array_key_exists('selected_flg', $params)) {
			Address::where('user_id', Auth::id())->where('selected_flg', config("common.flg.true"))->update(['selected_flg' => config("common.flg.false")]);
		} 
		Address::create($params);
		return redirect()->route('address.index')->with('flash_message', '住所の登録が完了しました');
	}

	public function update_selected_address (AddressSelectedRequest $request)
	// public function update_selected_address (Request $request)
	{
		DB::transaction(function() use ($request) {
			Address::where('user_id', Auth::id())->where('selected_flg', config("common.flg.true"))->update(['selected_flg' => config("common.flg.false")]);
			Address::where('id', $request->selected_flg)->update(['selected_flg' => config("common.flg.true")]);
		});
		return redirect()->route('address.index')->with('flash_message', '届け先の住所を変更しました');
	}

	public function showEditForm ($id)
	{
		$auth = Auth::user();
		$address = Address::where('user_id', $auth->id)->where('id', $id)->first();
		if (is_null($address)) {
			return redirect()->route('address.index')->with('message', '自分の住所以外変更できません');
		} else {
			$prefs = config('common.pref');
			return view('address.edit', compact('prefs', 'address'));
		}
	}
	public function edit ($id, AddressRequest $request)
	{
		$address = Address::where('id', $id)->first();
		$user_id = $address->user_id;
		$address->name = $request->name;
		$address->zip = $request->zip;
		$address->pref = $request->pref;
		$address->city = $request->city;
		$address->detail_address = $request->detail_address;
		$address->phone_num = $request->phone_num;
		$address->save();
		return redirect()->route('address.index')->with('flash_message', '住所の変更完了しました');
	}
	public function delete ($id, Request $request)
	{
		$auth = Auth::user();
		$address = Address::where('id', $id)->first();
		$user_id = $address->user_id;
		if ($auth->id == $user_id) {
			$address->delete();
			return redirect()->route('address.index')->with('flash_message', '選択した住所を削除しました');
		} else {
			return redirect()->route('address.index')->with('message', '自分の住所以外削除できません');
		}
	}
}


