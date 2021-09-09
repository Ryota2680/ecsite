<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
	use SoftDeletes;

	protected $fillable = [
		'user_id',
		'name',
		'zip',
		'pref',
		'city',
		'detail_address',
		'phone_num',
		'selected_flg',
	];

}
