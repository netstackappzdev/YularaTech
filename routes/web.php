<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\VerificationController;

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
Route::group(['namespace' => 'App\Http\Controllers'], function()
{  

    Route::get('/', function () {
        return view('home');
    });

    Route::get('/home', function () {
        return view('home');
    });

    View::composer('*', function ($view) {
        $view_name = str_replace('.', '_', $view->getName());
        View::share('view_name', $view_name);
    });

    Auth::routes();

    Route::get('/sign-up', [RegisterController::class, 'showRegistrationForm'])->name('signup');


    Route::group(['middleware' => ['auth']], function() {
        /**
        * Verification Routes
        */
        Route::get('/thank-you', 'VerificationController@show')->name('verification.notice');
        Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
        Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
    });

    Route::group(['middleware' => ['auth','verified']], function() {
        /**
         * Dashboard Routes
         */
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');
        //characters
        Route::resource('characters', 'CharacterController'); 
        Route::get('/characters/{id}', 'CharacterController@show')->name('characters.show');
        Route::get('characters', 'CharacterController@list')->name('characters');
        Route::get('user/characters', 'CharacterController@userlist')->name('user_characters');
    });

});
