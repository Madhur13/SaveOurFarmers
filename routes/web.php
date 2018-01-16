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
use App\Product;
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('pages.welcome');
});

Route::get('/user/logout','LoginController@getLogout');

Auth::routes();

// Route::get('/home', 'HomeController@index');
Route::get('/profile','UserController@profile')->middleware('auth');
Route::get('/buy','UserController@index')->middleware('auth');
Route::get('/sell','UserController@sell')->middleware('auth');
Route::post('/auction','AuctionController@index');
Route::get('/auction/{id}','AuctionController@show');
Route::get('/auction1/{name}',
['as' => 'auc','uses'=>'AuctionController@QuickSearch']
);
Route::get('/addveg','VegPostController@addveg');
Route::get('/ajax-subcat',function(){
  $cat_id = Input::get('cat_id');
  $products = Product::where('category_id','=',$cat_id)->get();

  return Response::json($products);
});

Route::post('/postveg','VegPostController@postveg');
Route::get('/getbidupdate/{id}','AuctionController@getbidupdate');
Route::get('/setbidupdate','AuctionController@setbidupdate');

Route::post('/editpostveg','VegPostController@editveg');
Route::get('/editprod/{id}','UserController@editproduct')->middleware('auth');
Route::get('/deleteprod/{id}','UserController@deleteproduct')->middleware('auth');
Route::get('/feedback/{id}','FeedbackController@feedback')->middleware('auth');
Route::post('/postfeedback','FeedbackController@postfeedback')->middleware('auth');
// Route::post('/setbidupdate','AuctionController@setbidupdate');
