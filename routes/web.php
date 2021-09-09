<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Route::get('/', 'ItemController@index');
// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'ItemController@index')->name('index');
Route::get('item/detail/{id}', 'ItemController@detail')->name('item.detail');

Route::group(['middleware' => 'auth:user'], function() {
	Route::get('cart/index', 'CartController@index')->name('cart.index');
	Route::post('cart/add', 'CartController@add')->name('cart.add');
	Route::get('cart/detail', 'CartController@delete')->name('cart.delete');
	Route::get('address/add', 'AddressController@showAddForm')->name('address.add');
	Route::post('address/add', 'AddressController@add')->name('address.add');
	Route::get('address/index', 'AddressController@index')->name('address.index');
	Route::get('address/edit/{id}', 'AddressController@showEditForm')->name('address.edit');
	Route::post('address/edit/{id}', 'AddressController@edit')->name('address.edit');
	Route::get('address/delete/{id}', 'AddressController@delete')->name('address.delete');
	// Route::post('address/update_selected_address/{address_id}', 'AddressController@update_selected_address')->name('address.update_selected_address');
	Route::post('address/update_selected_address', 'AddressController@update_selected_address')->name('address.update_selected_address');
});

/*
|--------------------------------------------------------------------------
| 2) User ログイン後
|--------------------------------------------------------------------------
*/
// Route::group(['middleware' => 'auth:user'], function() {
//     Route::get('/home', 'HomeController@index')->name('home');
// });


/*
	|--------------------------------------------------------------------------
	|  Admin 認証不要
	|--------------------------------------------------------------------------
 */
Route::group(['prefix' => 'admin'], function() {
	// Route::get('/', function () { return redirect('/admin/home'); });
	//ログインしていない時にadmin/にログインした場合('/admin/bbbb')に飛ぶ
	// Route::get('/', function () { return redirect('/admin/bbbb'); });
	Route::get('/', function () { return redirect('/admin/login'); });
	Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\LoginController@login');
});

/*
|--------------------------------------------------------------------------
| 4) Admin ログイン後
|--------------------------------------------------------------------------
*/
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {
    Route::post('logout',   'Admin\LoginController@logout')->name('admin.logout');
    Route::get('home',      'Admin\HomeController@index')->name('admin.home');
	// Route::get('home', 'Admin\ItemController@index')->name('aaa');
	Route::get('item/index', 'Admin\ItemController@index')->name('admin.item.index');

	Route::get('item/detail/{id}', 'Admin\ItemController@detail')->name('admin.item.detail');
	Route::get('item/add', 'Admin\ItemController@showAddForm')->name('admin.item.add');
	Route::post('item/add', 'Admin\ItemController@add')->name('admin.item.add');
	Route::get('item/edit/{id}', 'Admin\ItemController@showEditForm')->name('admin.item.edit');
	Route::post('item/edit/{id}', 'Admin\ItemController@edit')->name('admin.item.edit');

	// Route::get('user/index', 'Admin\UserController@index')->name('admin.user.index');
	// Route::get('user/detail/{id}', 'Admin\UserController@detail')->name('admin.user.detail');
});
