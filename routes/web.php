<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Mail\WelcomeMail;
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
// Route::get('/articles', function () {
//     return 'Article List';
//    });
// Route::get('/articles/detail', function () {
//     return 'Article Detail';
//    });
// Route::get('/articles/detail/{id}', function ( $id ) {
//     return "Article Detail - $id";
//    });

Route::resource('/products', 'ProductController');

Route::get('/new', function(){
    return view ('products.new');
});

Route::get('/articles', 'ArticleController@index');
Route::get('/articles/detail/{id}', 'ArticleController@detail');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/articles/add', 'ArticleController@add');
Route::post('/articles/add', 'ArticleController@create');
Route::get('/articles/delete/{id}', 'ArticleController@delete');
Route::post('/comments/add', 'CommentController@create');
Route::get('/comments/delete/{id}', 'CommentController@delete');

// Mail Auth Routing
Auth::routes(['verify' => true]);

Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

// Mailing Routes
Route::get('/email', function () {
    return new WelcomeMail();
})->middleware('verified');
