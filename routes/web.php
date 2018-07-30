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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//ATW


//LOADING
Route::resource('loadings', 'Loading\LoadingController');
Route::get('/json-loading', 'Loading\LoadingController@getLoading')->name('json-loading');
Route::resource('uncheckloading', 'UncheckLoading\UncheckLoadingController', ['only' => ['index', 'show']]);
Route::resource('addproduct', 'Loading\AddProductController', ['only' => ['index', 'show']]);
Route::get('/api/addproduct', 'Loading\AddProductController@getLoading');
Route::post('/api/addproduct', 'Loading\AddProductController@store');
Route::put('/api/addproduct/{id}', 'Loading\AddProductController@updateStatus');



//container
Route::resource('loadings.container', 'Loading\ContainerController');
Route::resource('loadings.container.detail', 'Loading\ContainerController', ['except' => ['store', 'update']]);



// Invoice
Route::resource('loadings.invoice', 'Invoice\InvoiceController');



//BOOKING ATW
Route::resource('booking', 'Booking\BookingController');


//Supplier
Route::resource('supplier', 'Supplier\SupplierController');
//Exporter
Route::resource('exporter','Exporter\ExporterController');
//Carrier
Route::resource('carrier','Carrier\CarrierController');
// sa Port of Loading (Origin)
Route::resource('portofloading','PortOfLoading\PortOfLoadingController');
//sa Port of Discharge (destination)
Route::resource('portofdischarge','PortOfDischarge\PortOfDischargeController');
//sa consignees
Route::resource('consignee','Consignee\ConsigneeController');