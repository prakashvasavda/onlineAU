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
Route::get('candidate-register/{service}', 'FrontRegisterController@index')->name('candidate-register');
Route::post('store_candidate', 'FrontRegisterController@store_candidate')->name('store_candidate');


Route::get('family-register', 'FrontRegisterController@family_register')->name('family-register');
Route::post('store_family', 'FrontRegisterController@store_family')->name('store_family');
Route::post('check-login', 'LoginController@check_login')->name('check-login');
Route::get('forgot-password', 'LoginController@forgot_password')->name('forgot-password');
Route::post('check-user', 'LoginController@check_user')->name('check-user');
Route::get('reset-password/{email}', 'LoginController@reset_password')->name('reset-password');
Route::post('create-new-password', 'LoginController@create_new_password')->name('create-new-password');

Route::get('contact-us', 'HomeController@contact_us')->name('contact-us');
Route::post('store-contact', 'HomeController@store_contact')->name('store-contact');

/*PUBLIC SEARCH ROUTES*/
Route::any('search/{search_parameters?}', 'SearchController@index')->name('search');

/*PUBLIC CANDIDATE ROUTES*/
Route::get('candidates', 'HomeController@candidates')->name('candidates');
Route::get('candidate-detail/{id}', 'FrontFamilyController@candidate_detail')->name('candidate-detail');
Route::get('candidates/{service}', 'HomeController@candidates')->name('candidates-service');


/*SIGN UP ROUTES*/
Route::get('sign-up/candidate', 'HomeController@sign_up')->name('sign-up-candidate');
Route::get('sign-up/family', 'HomeController@families')->name('sign-up-family');

/*PUBLIC PAYMENT ROUTE*/
Route::any('/payment/process', 'PaymentController@process_payment')->name('payment-process');

/*Terms and Conditions*/
Route::get('{service}/terms-and-condition', 'HomeController@terms_and_conditions')->name('terms-and-conditions');

Route::group(['middleware' => 'frontendauth'], function () {
    /*TRANSACTIONS ROUTES*/
    Route::get('transactions', 'FrontFamilyController@transactions')->name('transactions');
    Route::get('packages', 'FrontFamilyController@transactions')->name('packages');
    
    /*USER CANDIDATE ROUTES*/
    Route::post('store-candidate-reviews', 'FrontCandidateController@store_candidate_reviews')->name('store-candidate-reviews');
    Route::get('candidate/manage-profile', 'FrontCandidateController@manage_profile')->name('candidate-manage-profile');
    Route::put('update-candidate/{id}', 'FrontCandidateController@update_candidate')->name('update-candidate');
    Route::get('view-families', 'FrontCandidateController@view_families')->name('view-families');
    Route::get('family-detail/{id}', 'FrontCandidateController@family_detail')->name('family-detail');
    Route::post('store-candidate-favorite-family', 'FrontCandidateController@store_candidate_favorite_family')->name('store-candidate-favorite-family');
    Route::get('family/reviews', 'FrontCandidateController@reviews')->name('family-reviews');

    /*USER FAMILY ROUTES*/
    Route::post('store-family-review', 'FrontFamilyController@store_family_review')->name('store-family-review');
    Route::get('family/manage-profile', 'FrontFamilyController@manage_profile')->name('family-manage-profile');
    Route::put('update-family/{id}', 'FrontFamilyController@update_family')->name('update-family');
    Route::get('all-candidates', 'FrontFamilyController@view_all_candidates')->name('all-candidates');
    Route::get('view-candidates/{service?}', 'FrontFamilyController@view_candidates')->name('view-candidates');
    Route::post('store-family-favourite-candidate', 'FrontFamilyController@store_family_favourite_candidate')->name('store-family-favourite-candidate');
    Route::get('candidate/reviews', 'FrontFamilyController@reviews')->name('candidate-reviews');

    /*USER CANDIDATE MANAGE CALENDER ROUTES*/
    Route::get('candidate/manage-calender', 'FrontCandidateController@edit_candidate_calender')->name('candidate-manage-calender');
    Route::put('update-candidate-calender/{id}', 'FrontCandidateController@update_candidate_calender')->name('update-candidate-calender');

    /*USER FAMILY MANAGE CALENDER ROUTES*/
    Route::get('family/manage-calender', 'FrontFamilyController@edit_family_calender')->name('family-manage-calender');
    Route::put('update-family-calender/{id}', 'FrontFamilyController@update_family_calender')->name('update-family-calender');

    /*USER SUBSCRIPTIONS*/
    Route::post('cancel-user-subscription', 'User\SubscriptionController@cancel_user_subscription')->name('cancel-user-subscription');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('change-password', 'AdminController@change_password')->name('admin.change-password');
    Route::get('packages', 'AdminController@packages')->name('admin.packages');
    Route::post('update-password', 'AdminController@update_password')->name('admin.update-password');
    Route::post('store_features', 'AdminController@store_features')->name('admin.store_features');
    Route::any('statusCandidates', 'AdminController@statusCandidates')->name('admin.statusCandidates');
    Route::any('destroyCandidates', 'AdminController@destroyCandidates')->name('admin.destroyCandidates');
    Route::any('destroyFamilies', 'AdminController@destroyFamilies')->name('admin.destroyFamilies');
    Route::any('features/{id}', 'AdminController@features')->name('admin.features');

    Route::get('contact', 'AdminController@contact')->name('admin.contact');
    Route::any('get-contact', 'AdminController@get_contact')->name('admin.get-contact');
    Route::any('destroyContact', 'AdminController@destroyContact')->name('admin.destroyContact');

    /*ADMIN TRANSACTION ROUTES*/
    Route::get('transactions', 'TransactionController@index')->name('admin.transactions');

    /*ADMIN REVIEW ROUTES*/
    Route::get('reviews', 'ReviewController@index')->name('admin.reviews');
    Route::post('delete-review/{id}', 'ReviewController@destroy')->name('admin.delete-review');

    /*ADMIN CANDIDATE ROUTES*/
    Route::get('candidates', 'CandidateController@index')->name('admin.candidates');
    Route::any('get_candidates', 'CandidateController@get_candidates')->name('admin.get_candidates');
    Route::get('edit-candidate/{id}', 'CandidateController@edit')->name('admin.edit-candidate');
    Route::put('update-candidate/{id}', 'CandidateController@update')->name('admin.update-candidate');

    /*ADMIN FAMILY ROUTES*/
    Route::get('families', 'FamilyController@index')->name('admin.families');
    Route::any('get_families', 'FamilyController@get_families')->name('admin.get_families');
    Route::get('edit-family/{id}', 'FamilyController@edit')->name('admin.edit-family');
    Route::put('update-family/{id}', 'FamilyController@update')->name('admin.update-family');

});
