<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CartController extends Controller
{
	public function index ()
	{
		$user_id = Auth::user()->id;
		$carts = Cart::with('item')->where('user_id', $user_id)->get();
		$total = 0;
		foreach ($carts as $cart) {
			$total += $cart->item->price * $cart->quantity;
		}
		return view('cart.index', compact('carts', 'total'));
	}

	public function add (Request $request)
	{
		$item = Item::find($request->id);
		$user_id = Auth::id();
		$item_id = $item->id;
		$quantity = $request->quantity;
		$request->validate([
			'quantity' => "required|integer|min:1|"
		]);
		DB::beginTransaction();
		try {
			if ($quantity > $item->stock) {
				return redirect()->route('item.detail', ['id' => $item_id])->with('flash_message', '在庫がありません');
			} else {
			//	$cart = Cart::firstOrNew([
				$cart = Cart::firstOrCreate([
					'user_id' => $user_id,
					'item_id' => $item_id,
				], [
					'quantity' => $quantity,
				]);
				//新しくレコードが作られていなければtrue
				if (!$cart->wasRecentlyCreated) {
					$cart->quantity += $quantity;
					$cart->save();
				}
				$item->stock -= $request->quantity;
				$item->save();
				DB::commit();
			}
		} catch (Exception $exception) {
			DB::rollBack();
			throw $exception;
		}
		return redirect()->route('cart.index')->with('flash_message', '商品をカートに追加しました');
	}

	public function delete (Request $request)
	{
		$id = $request->id;
		$cart = Cart::find($id);
		$user_id = $cart->user_id;
		if (Auth::user()->id == $user_id) {
			$item = Item::find($cart->item_id);
			$item->stock += $cart->quantity;
			$item->save();
			$cart->delete();
			return redirect()->route('cart.index')->with('flash_message', 'カートから商品を削除しました');
		} else {
			return redirect()->route('cart.index')->with('flash_message', '自分のカート以外操作できません');
		}
	}
}


