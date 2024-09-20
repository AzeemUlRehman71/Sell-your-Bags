<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Artisan;
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

// Route::get('/clear-cache', function(){
//     Artisan::call('view:clear');
//    // exec('composer dump-autoload');

//     return 'Optimize and cache cleared successfully';

// });
// Route::get('/','App\Http\Controllers\ClientController@create')->name('sellyourbags.create');

// Route::post('/sellyourbags/store','App\Http\Controllers\ClientController@store')->name('sellyourbags.store');

// Route::get('/thankyou/{id}/{po?}',function($id,$po){

//     return view('frontend/pages/thankyou',['id'=>$id ,'po' =>$po]);

// })->name('sellyourbags.thankyou');


// Route::post('/print/{id}','App\Http\Controllers\ClientController@print')->name('print');

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('login-with-pin', 'App\Http\Controllers\Auth\LoginController@loginWithPinView')->name('login_with_pin_view');
Route::post('login-with-pin', 'App\Http\Controllers\Auth\LoginController@loginWithPin')->name('login_with_pin');

Auth::routes([

    'register' => false, // Register Routes...

    // 'reset' => false, // Reset Password Routes...

    // 'verify' => false, // Email Verification Routes...

]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/', 'App\Http\Controllers\ClientController@create')->name('sellyourbags.create');

    Route::post('/sellyourbags/store', 'App\Http\Controllers\ClientController@store')->name('sellyourbags.store');

    Route::get('/thankyou/{id}/{po?}', function ($id, $po) {

        return view('frontend/pages/thankyou', ['id' => $id, 'po' => $po]);
    })->name('sellyourbags.thankyou');


    Route::post('/print/{id}', 'App\Http\Controllers\ClientController@print')->name('print');
    Route::get('/barcode-print/{id}', 'App\Http\Controllers\ClientController@barcodePrint')->name('barcode-print');

    Route::post('filepond-upload', 'App\Http\Controllers\ClientController@filepondprocess');
    Route::delete('filepond-delete', 'App\Http\Controllers\ClientController@filepondDelete');


    //  Route::post('filepond-upload-product','App\Http\Controllers\ProductController@filepondprocess');
    //  Route::delete('filepond-delete-product','App\Http\Controllers\ProductController@filepondDelete');

    //Route::get('filepond-restore/{id}','App\Http\Controllers\ClientController@filepondRestore');
    //      Route::get('filepond-restore',function(){

    //        return 'Hello World';
    //  });

});


Route::group(['middleware' => 'auth'], function () {
    Route::group(['namespace' => '\App\Http\Controllers'], function () {



        // =============================================
        // User Route Start
        // user Index Route
        Route::get('/user/index', [

            'uses' => 'UserController@index',
            'as' => 'user.index',
            // 'middleware' => 'isAdmin'
        ]);

        Route::get('/user/create', [

            'uses' => 'UserController@create',
            'as' => 'user.create',


        ]);

        Route::get('/user/role-create', [

            'uses' => 'UserController@role',
            'as' => 'user.users_role',


        ]);

        Route::get('/user/role', [

            'uses' => 'UserController@userole',
            'as' => 'user.user_role',


        ]);

        Route::post('/user/store', [

            'uses' => 'UserController@store',
            'as' => 'user.store',

        ]);

        Route::post('/user/role_store', [

            'uses' => 'UserController@role_store',
            'as' => 'user.role_store',

        ]);

        Route::get('/user/{id}/edit', [

            'uses' => 'UserController@edit',
            'as' => 'user.edit',


        ]);

        Route::get('/user_role/{id}/edit', [

            'uses' => 'UserController@user_role_edit',
            'as' => 'user_role.edit',


        ]);

        Route::post('/user_role/{id}/role_update', [

            'uses' => 'UserController@role_update',
            'as' => 'user_role.update',


        ]);

        Route::post('/user_role/delete', [

            'uses' => 'UserController@delete',
            'as' => 'user.role_delete',
            // 'middleware' => 'permission:view product'
        ]);

        Route::post('/user/{id}/update', [

            'uses' => 'UserController@update',
            'as' => 'user.update',


        ]);

        Route::post('/user/delete', [

            'uses' => 'UserController@destroy',
            'as' => 'user.delete',


        ]);

        Route::get('/set-login-pin', [
            'uses' => 'UserController@setLoginPin',
            'as' => 'set_login_pin',
        ]);

        Route::post('/set-login-pin', [
            'uses' => 'UserController@setLoginPinStore',
            'as' => 'set_login_pin.store',
        ]);



        // Edit product details
        Route::post('/product/detail/edit', [

            'uses' => 'ClientController@editProductDetails',
            'as' => 'client.edit_product_details'
        ]);
        Route::get('/pos/index', [

            'uses' => 'ClientController@index',
            'as' => 'pos.index',
            //'middleware' => 'permission:show user'
        ]);

        Route::get('/pos/datatables', [
            'uses' => 'ClientController@posDatatables',
            'as' => 'pos.datatables',
            //'middleware' => 'permission:show user'
        ]);

        Route::get('/pos/all', [

            'uses' => 'ClientController@all',
            'as' => 'pos.all',
            //'middleware' => 'permission:show user'
        ]);

        Route::get('/pos/tagged/{id}', [

            'uses' => 'ClientController@tagged',
            'as' => 'pos.tagged',
            //'middleware' => 'permission:show user'
        ]);
        Route::get('/pos/product-item-tagged/{id}', [

            'uses' => 'ClientController@taggedProductItem',
            'as' => 'pos.product-item-tagged',
            //'middleware' => 'permission:show user'
        ]);
        Route::get('/pos/{id}/view', [

            'uses' => 'ClientController@show',
            'as' => 'client.view',
            // 'middleware' => 'permission:view product'
        ]);

        // Edit client status
        Route::post('/product/unit/edit', [

            'uses' => 'ClientController@editProductUnit',
            'as' => 'client.edit_unit'
        ]);

        Route::post('/pos/product/detail/add/', [

            'uses' => 'ProductController@store',
            'as' => 'pos.add_product_details'
        ]);

        Route::get('/pos/update-history/{id}', [
            'uses' => 'ClientController@updateHistory',
            'as' => 'pos.update_history'
        ]);

        Route::get('/pos/fetch-condition-report/{id}', [
            'uses' => 'ClientController@fetchConditionReport',
            'as' => 'post.condition-report.fetch',
        ]);

        Route::get('/pos/fetch-comparison-report/{id}', [
            'uses' => 'ClientController@fetchComparisonReport',
            'as' => 'pos.condition-comparison-report.fetch',
        ]);

        Route::post('/pos/save-condition-reoprt', [
            'uses' => 'ClientController@saveConditionReport',
            'as' => 'post.condition-report.save',
        ]);

        Route::post('/product/delete', [

            'uses' => 'ProductController@destroy',
            'as' => 'product.delete',


        ]);

        Route::post('/product/detail/delete-image', [
            'uses' => 'ClientController@deleteImage',
            'as' => 'client.delete_product_image'
        ]);


        Route::get('/pos/{id}/edit', [

            'uses' => 'ClientController@editClient',
            'as' => 'client.edit',
            // 'middleware' => 'isAdmin'

        ]);
        Route::post('/pos/{id}/update', [

            'uses' => 'ClientController@update',
            'as' => 'client.update',
            //'middleware' => 'permission:edit product'
        ]);
    });
});

// Route::get('refactor', function() {
//     DB::statement("ALTER TABLE products MODIFY COLUMN image_path text");
//     $products = \App\Models\Product::all();
//     foreach ($products as $product) {
//         if ($product->image_path) {
//             $product->image_path = json_encode([$product->image_path]);
//         } else {
//             $product->image_path = json_encode([]);
//         }
//         $product->save();
//     }
//     echo 'done';
// });
