<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/','App\Http\Controllers\ClientController@create')->name('sellyourbags.create');

// Route::post('/sellyourbags/store','App\Http\Controllers\ClientController@store')->name('sellyourbags.store');

// Route::get('/thankyou/{id}/{po?}',function($id,$po){

//     return view('frontend/pages/thankyou',['id'=>$id ,'po' =>$po]);

// })->name('sellyourbags.thankyou');


// Route::post('/print/{id}','App\Http\Controllers\ClientController@print')->name('print');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();





Route::group(['middleware' => 'auth'], function (){
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/','App\Http\Controllers\ClientController@create')->name('sellyourbags.create');

    Route::post('/sellyourbags/store','App\Http\Controllers\ClientController@store')->name('sellyourbags.store');

    Route::get('/thankyou/{id}/{po?}',function($id,$po){

            return view('frontend/pages/thankyou',['id'=>$id ,'po' =>$po]);

        })->name('sellyourbags.thankyou');


    Route::post('/print/{id}','App\Http\Controllers\ClientController@print')->name('print');
 
});


Route::group(['middleware' => 'auth'], function (){
    Route::group(['namespace' => '\App\Http\Controllers'], function() {

          // Edit product details
          Route::post('/product/detail/edit', [

            'uses' => 'ClientController@editProductDetails',
            'as' => 'client.edit_product_details'
        ]);
        Route::get('/clients/index', [

            'uses' => 'ClientController@index',
            'as' => 'pos.index',
            //'middleware' => 'permission:show user'
        ]);
        Route::get('/client/{id}/view', [

            'uses' => 'ClientController@show',
            'as' => 'client.view',
           // 'middleware' => 'permission:view product'
        ]);

         // Edit client status
         Route::post('/product/unit/edit', [

            'uses' => 'ClientController@editProductUnit',
            'as' => 'client.edit_unit'
        ]);

          

        Route::get('/client/{id}/edit', [

            'uses' => 'ClientController@editClient',
            'as' => 'client.edit',
           // 'middleware' => 'isAdmin'
           
        ]);
        Route::post('/client/{id}/update', [

            'uses' => 'ClientController@update',
            'as' => 'client.update',
            //'middleware' => 'permission:edit product'
        ]);      

    });
});



