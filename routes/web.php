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
})->name('landing');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');


//LOADING
Route::resource('loadings', 'Loading\LoadingController', ['only'=> ['create','update']]);
Route::get('/json-loading', 'Loading\LoadingController@getLoading')->name('json-loading');
//ADD LOADING
Route::resource('addproduct', 'Loading\AddProductController', ['only' => ['index', 'show']]);
Route::get('/api/addproduct', 'Loading\AddProductController@getLoading');
Route::post('/api/addproduct', 'Loading\AddProductController@store');
Route::put('/api/addproduct/{id}', 'Loading\AddProductController@updateStatus');
//UNCHECK LOADING
Route::resource('uncheckloading', 'UncheckLoading\UncheckLoadingController', ['only' => ['index', 'show']]);
Route::get('/api/uncheckloading', 'UncheckLoading\UncheckLoadingController@getLoading');
Route::put('/api/uncheckloading/{id}', 'UncheckLoading\UncheckLoadingController@updateStatus');
//APPROVED LOADING
Route::resource('approvedloading', 'Loading\ApprovedLoading', ['only' => ['index', 'show']]);
Route::get('/api/approvedloading', 'Loading\ApprovedLoading@getLoading');
//DISAPPROVED LOADING
Route::resource('disapprovedloading', 'Loading\DisapprovedLoading', ['only' => ['index', 'show']]);
Route::get('/api/disapprovedloading', 'Loading\DisapprovedLoading@getLoading');
//CONTAINER
Route::resource('addproduct.container', 'Container\ContainerController', ['only' => ['show']]);
Route::get('/api/addproduct/{addproduct}/container/{container}', 'Container\ContainerController@getContainer');
Route::post('/api/addproduct/{addproduct}/container', 'Container\ContainerController@store')->name('addproduct.container.store');
Route::put('/api/addproduct/{addproduct}/container/{container}', 'Container\ContainerController@update')->name('addproduct.container.update');
Route::put('/api/addproduct/{addproduct}/seal/{container}', 'Container\ContainerController@updateSeal')->name('addproduct.seal.update');
//PRODUCT
Route::resource('api/product', 'Product\ProductController', ['only' => ['index']]);
//PRICING
Route::resource('pricing', 'Pricing\PricingController');
//Route::resource('loading.pricing', 'Pricing\PricingLoadingController');



//container
//Route::resource('loadings.container', 'Loading\ContainerController');
//Route::resource('loadings.container.detail', 'Loading\ContainerController', ['except' => ['store', 'update']]);



// Invoice
Route::resource('loadings.invoice', 'Invoice\InvoiceController');



//BOOKING
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