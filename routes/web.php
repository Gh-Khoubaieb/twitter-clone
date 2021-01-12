<?php

use App\Http\Controllers\TweetController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('tweets', [TweetController::class, 'index'] )->name('tweets.index') ;


Route::group(['midleware' => ['auth:sanctum' , 'verified']], function() {
    Route::post('tweets', [TweetController::class, 'store'] )->name('tweets.store') ;

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return Inertia\Inertia::render('Dashboard');
    })->name('dashboard');

    Route::post('/follows/{user:id}', [TweetController::class, 'follows'])->name('tweets.follows');
    Route::post('/unfollows/{user:id}', [TweetController::class, 'unfollows'])->name('tweets.unfollows');

    Route::get('/followings', [TweetController::class, 'followings'])->name('tweets.followings');

    Route::post('/delete/{tweets:id}', [TweetController::class, 'delete'])->name('tweets.delete');

    Route::get('/profile/{user:name}', [TweetController::class, 'profile'])->name('tweets.profile');
}) ;
