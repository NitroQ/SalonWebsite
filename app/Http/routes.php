<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PageController@index')->name('home');
Route::get('/services', 'PageController@services');
Route::get('/gallery', 'PageController@gallery'); 
Route::get('/contact', 'PageController@contact');
Route::get('/about', 'PageController@about');
Route::get('/admin', function () {
    return redirect('/admin/dashboard');
});

Route::get('/login', 'UserController@login')->name('login');
Route::post('/login', 'UserController@authenticate')->name('login-post');
Route::post('/authenticate', 'UserController@authenticate')->name('authenticate');
Route::get('/logout', 'UserController@logout')->name('logout');

Route::group(['prefix' => 'api'], function() {
	Route::get('/test-server', "PosController@testServer");
	Route::get('/fetch-products', "PosController@fetchProducts");
	Route::get('/fetch-services', "PosController@fetchServices");
	Route::post('/submit-payment', "PosController@submitPayment");
});

// AUTHENTICATION
Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function() {

		//Dashboard
		Route::get('/dashboard', 'PageController@dashboard')->name('admin.dashboard');

		// Sales Order
		Route::get('/sales-order', 'SalesOrderController@index')->name('admin.sales-order.index');
		Route::get('/sales-order/{id}', 'SalesOrderController@show')->name('admin.sales-order.show');
		Route::get('/sales-order/{id}/print', 'SalesOrderController@printSO')->name('admin.sales-order.print');
		Route::get('/sales-order/{id}/edit', 'SalesOrderController@edit')->name('admin.sales-order.edit');
		Route::post('/sales-order/{id}/update', 'SalesOrderController@update')->name('admin.sales-order.update');

		//Daily Sales
		Route::get('/daily-sales', 'SalesOrderController@dailysales')->name('admin.daily-sales.index');
		Route::post('/daily-sales', 'SalesOrderController@filter')->name('admin.daily-sales.post');
		Route::post('/daily-sales/print', 'SalesOrderController@printReport')->name('admin.daily-sales.print');
		Route::post('/daily-sales/download/pdf', 'SalesOrderController@downloadPdfReport')->name('admin.daily-sales.pdf');
		Route::post('/daily-sales/download/xls', 'SalesOrderController@downloadXlsReport')->name('admin.daily-sales.xls');
		Route::post('/daily-sales/download/csv', 'SalesOrderController@downloadCsvReport')->name('admin.daily-sales.csv');

		// Purchase Order
		Route::get('/purchase-order', 'PurchaseOrderController@index')->name('admin.purchase-order.index');
		Route::get('/purchase-order/create', 'PurchaseOrderController@create')->name('admin.purchase-order.create');
		Route::post('/purchase-order/store', 'PurchaseOrderController@store')->name('admin.purchase-order.store');
		Route::get('/purchase-order/{id}', 'PurchaseOrderController@show')->name('admin.purchase-order.show');
		Route::get('/purchase-order/{id}/status/{status}', 'PurchaseOrderController@setStatus')->name('admin.purchase-order.set-status');
		Route::get('/purchase-order/{id}/edit', 'PurchaseOrderController@edit')->name('admin.purchase-order.edit');
		Route::post('/purchase-order/{id}/update', 'PurchaseOrderController@update')->name('admin.purchase-order.update');
		Route::get('/purchase-order/{id}/delete', 'PurchaseOrderController@delete')->name('admin.purchase-order.delete');
		// Route::get('/purchase-order/{id}/print', 'PurchaseOrderController@printPO')->name('admin.purchase-order.print');

		//Receiving Order
		Route::get('/receive-order', 'ReceivingOrderController@index')->name('admin.receiving-order.index');
		Route::get('/receive-order/{id}', 'ReceivingOrderController@show')->name('admin.receiving-order.show');
		Route::get('/receive-order/{id}/status/{status}', 'ReceivingOrderController@setStatus')->name('admin.receiving-order.set-status');
		
		//Suppliers
		Route::get('/suppliers', 'SupplierController@index')->name('admin.inventory.suppliers.index');
		Route::get('/suppliers/create', 'SupplierController@create')->name('admin.inventory.suppliers.create');
		Route::post('/suppliers/create/add', 'SupplierController@store')->name('admin.inventory.suppliers.store');
		Route::get('/suppliers/delete/{id}','SupplierController@destroy')->name('admin.inventory.suppliers.delete');
		Route::get('/suppliers/create/{id}/edit', 'SupplierController@edit')->name('admin.inventory.suppliers.edit');
		Route::post('/suppliers/create/{id}/update', 'SupplierController@update')->name('admin.inventory.suppliers.update');
		Route::get('/suppliers/delete/{id}/delete','SupplierController@destroy')->name('admin.inventory.suppliers.delete');

		//Products
		Route::get('/products', 'ProductsController@index')->name('admin.products.index');
		Route::get('/products/create', 'ProductsController@create')->name('admin.products.create');
		Route::post('/products/create/add', 'ProductsController@store')->name('admin.products.store');
		Route::get('/products/create/{id}/edit', 'ProductsController@edit')->name('admin.products.edit');
		Route::post('/products/create/{id}/update', 'ProductsController@update')->name('admin.products.update');
		Route::get('/products/delete/{id}','ProductsController@destroy')->name('admin.products.delete');

		Route::group(['middleware' => ['admin'], 'prefix' => 'superadmin'], function(){
			//Users-ss
			Route::get('/users', 'UserController@index')->name('admin.users.index');
			Route::get('/users/create', 'UserController@create')->name('admin.users.create');
			Route::post('/users/create/add', 'UserController@store')->name('admin.users.store');
			Route::get('/users/create/{id}/edit', 'UserController@edit')->name('admin.users.edit');
			Route::post('/users/create/{id}/update', 'UserController@update')->name('admin.users.update');
			Route::get('/users/delete/{id}/delete','UserController@destroy')->name('admin.users.delete');
		});

	
});
