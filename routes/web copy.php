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
// Route::get('/sellyourbags','App\Http\Controllers\ClientController@create')->name('sellyourbags.create');
Route::get('/','App\Http\Controllers\ClientController@create')->name('sellyourbags.create');



Route::post('/sellyourbags/store','App\Http\Controllers\ClientController@store')->name('sellyourbags.store');

//Route::get('/thankyou/{id}','App\Http\Controllers\ClientController@thankyou')->name('sellyourbags.thankyou');

Route::get('/thankyou/{id}',function($id){

   // dd($id);

    return view('frontend/pages/thankyou',['id'=>$id]);
    //  return view('frontend/pages/thankyou')->with('name','World');

})->name('sellyourbags.thankyou');


Route::post('/print/{id}','App\Http\Controllers\ClientController@print')->name('print');

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/sellyourbags',function(){

//     return view('frontend/pages/sellyourbags');

// });
// //Route::group(['middleware' => 'web'], function (){
//     Route::group(['namespace' => '\App\Http\Controllers'], function() {
//         //store routes
//         Route::get('/sellyourbags', [

//         'uses' => 'ClientController@create',
//         'as' => 'sellyourbags.create',
//         //'middleware' => 'isAdmin'
//         ]);
//         Route::post('/sellyourbags/store', [

//             'uses' => 'ClientController@store',
//             'as' => 'sellyourbags.store',
//             //'middleware' => 'isAdmin'
//         ]);
//     });
//});


Route::group(['middleware' => 'auth'], function (){
    Route::group(['namespace' => '\App\Http\Controllers'], function() {

       

        // =============================================
        // Sale Route Start
    
        Route::get('/clients/index', [

            'uses' => 'ClientController@index',
            'as' => 'client.index',
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
       


        

    });
});



