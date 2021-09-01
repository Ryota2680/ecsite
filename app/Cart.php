<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model

{
	use SoftDeletes;

	protected $table = 'carts';
	public function item()
	{
//リレーション1対多
		return $this->belongsTo('App\Item', 'item_id');
	}   //
	public function user()
	{
//リレーション1対多
		return $this->belongsTo('App\User', 'user_id');
	}
	public $fillable = [
		'user_id', 'item_id', 'quantity', 'test'
		//'user_id', 'item_id', 'quantity'
	];
}
