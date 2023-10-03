<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::get('user-logout', 'HomeController@user_logout')->name('user-logout');
Route::get('user-login', 'LoginController@index')->name('user-login');
Route::get('candidates', 'FrontRegisterController@candidates')->name('candidates');
Route::get('candidate-register/{service}', 'FrontRegisterController@index')->name('candidate-register');
Route::post('store_candidate', 'FrontRegisterController@store_candidate')->name('store_candidate');
Route::get('candidate-detail/{id}', 'FrontRegisterController@candidate_detail')->name('candidate-detail');


Route::get('families', 'FrontRegisterController@families')->name('families');
Route::get('family-register', 'FrontRegisterController@family_register')->name('family-register');
Route::post('store_family', 'FrontRegisterController@store_family')->name('store_family');
Route::post('check-login', 'LoginController@check_login')->name('check-login');
Route::get('forgot-password', 'LoginController@forgot_password')->name('forgot-password');
Route::post('check-user', 'LoginController@check_user')->name('check-user');
Route::get('reset-password/{email}', 'LoginController@reset_password')->name('reset-password');
Route::post('create-new-password', 'LoginController@create_new_password')->name('create-new-password');

Route::get('contact-us', 'HomeController@contact_us')->name('contact-us');

Route::group(['middleware' => 'frontendauth'], function () {
});
Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('change-password', 'AdminController@change_password')->name('admin.change-password');
    Route::get('packages', 'AdminController@packages')->name('admin.packages');
    Route::post('update-password', 'AdminController@update_password')->name('admin.update-password');
    Route::post('store_features', 'AdminController@store_features')->name('admin.store_features');
    Route::get('candidates', 'AdminController@candidates')->name('admin.candidates');
    Route::any('statusCandidates', 'AdminController@statusCandidates')->name('admin.statusCandidates');
    Route::any('destroyCandidates', 'AdminController@destroyCandidates')->name('admin.destroyCandidates');
    Route::any('get_candidates', 'AdminController@get_candidates')->name('admin.get_candidates');
    Route::get('families', 'AdminController@families')->name('admin.families');
    Route::any('destroyFamilies', 'AdminController@destroyFamilies')->name('admin.destroyFamilies');
    Route::any('get_families', 'AdminController@get_families')->name('admin.get_families');
    Route::any('features/{id}', 'AdminController@features')->name('admin.features');
});
