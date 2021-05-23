<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
	public function index ()
	{
		$items = Item::get();
		return view('admin.item.index', compact('items'));
	}
	public function detail ($id)
	{
		$item = Item::where('id', $id)->first();
		return view('admin.item.detail', compact('item'));
	}
	public function showAddForm()
	{
		return view('admin.item.add');
	}
	public function add(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:100',
			'description' => 'required|string|max:255',
			'price' => 'required|integer|min:0',
			'stock' => 'required|integer|min:0',
			'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);
		$item = new Item();
		$item->name = $request->name;
		$item->description = $request->description;
		$item->price = $request->price;
		$item->stock = $request->stock;
		if ($request->file('image')) {
			$image_name = $request->file('image')->store('public/item_image');
			$item->image = basename($image_name);
		}
		$item->save();
		return redirect()->route('admin.item.index');
	}
	public function showEditForm($id)
	{
		$item = Item::find($id);
		return view('admin.item.edit', compact('item'));
	}
	public function edit(Request $request, $id)
	{
		$request->validate([
			'name' => 'required|string|max:100',
			'description' => 'required|string|max:255',
			'stock' => 'required|integer|min:0',
			'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
		]);
		$item = Item::find($id);
		if ($request->file('image')) {
			Storage::delete('public/item_image/' . $item->image);
			$image_name = $request->file('image')->store('public/item_image');
			$item->image = basename($image_name);
		}
		$item->name = $request->name;
		$item->description = $request->description;
		$item->stock = $request->stock;
		$item->save();
		return redirect()->route('admin.item.index');
	}
}

