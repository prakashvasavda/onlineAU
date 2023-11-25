<?php

use Illuminate\Support\Facades\Route;
/*general*/
use App\Http\Controllers\Controller;

/*user*/
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\FrontRegisterController;
use App\Http\Controllers\User\SearchController;
use App\Http\Controllers\User\FrontFamilyController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\FrontCandidateController;
use App\Http\Controllers\User\SubscriptionController;

/*admin*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\AupairsController;
use App\Http\Controllers\Admin\BabysittersController;
use App\Http\Controllers\Admin\NanniesController;
use App\Http\Controllers\Admin\PetsittersController;
use App\Http\Controllers\Admin\ReviewsController;
use App\Http\Controllers\Admin\TransactionsController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('user-logout', [HomeController::class, 'user_logout'])->name('user-logout');
Route::get('user-login', [LoginController::class, 'index'])->name('user-login');
Route::get('candidate-register/{service}', [FrontRegisterController::class, 'index'])->name('candidate-register');
Route::post('store_candidate', [FrontRegisterController::class, 'store_candidate'])->name('store_candidate');

Route::get('family-register', [FrontRegisterController::class, 'family_register'])->name('family-register');
Route::post('store_family', [FrontRegisterController::class, 'store_family'])->name('store_family');
Route::post('check-login', [LoginController::class, 'check_login'])->name('check-login');
Route::get('forgot-password', [LoginController::class, 'forgot_password'])->name('forgot-password');
Route::post('check-user', [LoginController::class, 'check_user'])->name('check-user');
Route::get('reset-password/{email}', [LoginController::class, 'reset_password'])->name('reset-password');
Route::post('create-new-password', [LoginController::class, 'create_new_password'])->name('create-new-password');

Route::get('contact-us', [HomeController::class, 'contact_us'])->name('contact-us');
Route::post('store-contact', [HomeController::class, 'store_contact'])->name('store-contact');

/* PUBLIC SEARCH ROUTES */
Route::any('search/{search_parameters?}', [SearchController::class, 'index'])->name('search');

/* PUBLIC CANDIDATE ROUTES */
Route::get('candidates', [HomeController::class, 'candidates'])->name('candidates');
Route::get('candidate-detail/{id}', [FrontFamilyController::class, 'candidate_detail'])->name('candidate-detail');
Route::get('candidates/{service}', [HomeController::class, 'candidates'])->name('candidates-service');

/* SIGN UP ROUTES */
Route::get('sign-up/{service}', [HomeController::class, 'sign_up'])->name('sign-up');

/* Terms and Conditions */
Route::get('{service}/terms-and-condition', [HomeController::class, 'terms_and_conditions'])->name('terms-and-conditions');

/* Package route */
Route::get('packages', [HomeController::class, 'packages'])->name('packages');

Route::group(['middleware' => 'frontendauth'], function () {
    /* REDIRECT TO PAYMENT GATEWAY */
    Route::any('/payment/process', [PaymentController::class, 'process_payment'])->name('payment-process');

    /* TRANSACTIONS ROUTES */
    Route::get('transactions', [FrontFamilyController::class, 'transactions'])->name('transactions');

    /* USER CANDIDATE ROUTES */
    Route::post('store-candidate-reviews', [FrontCandidateController::class, 'store_candidate_reviews'])->name('store-candidate-reviews');
    Route::get('candidate/manage-profile', [FrontCandidateController::class, 'manage_profile'])->name('candidate-manage-profile');
    Route::put('update-candidate/{id}', [FrontCandidateController::class, 'update_candidate'])->name('update-candidate');
    Route::get('view-families', [FrontCandidateController::class, 'view_families'])->name('view-families');
    Route::get('family-detail/{id}', [FrontCandidateController::class, 'family_detail'])->name('family-detail');
    Route::post('store-candidate-favorite-family', [FrontCandidateController::class, 'store_candidate_favorite_family'])->name('store-candidate-favorite-family');
    Route::get('family/reviews', [FrontCandidateController::class, 'reviews'])->name('family-reviews');

    /* USER FAMILY ROUTES */
    Route::post('store-family-review', [FrontFamilyController::class, 'store_family_review'])->name('store-family-review');
    Route::get('family/manage-profile', [FrontFamilyController::class, 'manage_profile'])->name('family-manage-profile');
    Route::put('update-family/{id}', [FrontFamilyController::class, 'update_family'])->name('update-family');
    Route::get('all-candidates', [FrontFamilyController::class, 'view_all_candidates'])->name('all-candidates');
    Route::get('view-candidates/{service?}', [FrontFamilyController::class, 'view_candidates'])->name('view-candidates');
    Route::post('store-family-favourite-candidate', [FrontFamilyController::class, 'store_family_favourite_candidate'])->name('store-family-favourite-candidate');

    /* USER CANDIDATE MANAGE calender ROUTES */
    Route::get('candidate/manage-calender', [FrontCandidateController::class, 'edit_candidate_calender'])->name('candidate-manage-calender');
    Route::put('update-candidate-calender/{id}', [FrontCandidateController::class, 'update_candidate_calender'])->name('update-candidate-calender');

    /* USER FAMILY MANAGE calender ROUTES */
    Route::get('family/manage-calender', [FrontFamilyController::class, 'edit_family_calender'])->name('family-manage-calender');
    Route::put('update-family-calender/{id}', [FrontFamilyController::class, 'update_family_calender'])->name('update-family-calender');

    /* USER SUBSCRIPTIONS */
    Route::post('cancel-user-subscription', [SubscriptionController::class, 'cancel_user_subscription'])->name('cancel-user-subscription');

    /*REVIEW*/
    Route::get('reviews/{service?}', [FrontFamilyController::class, 'reviews'])->name('reviews');

});



Auth::routes();

Route::prefix('admin')->middleware(['auth'])->group(function () {
    /*dashbaord*/
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    /*profile*/
    Route::resource('profile', ProfileController::class)->names('admin.profile');
    
    /*family*/
    Route::get('families', [FamilyController::class, 'view_families'])->name('admin.families');
    Route::get('edit-family/{id}', [FamilyController::class, 'edit_family'])->name('admin.edit-family');
    Route::put('update-family/{id}', [FamilyController::class, 'update_family'])->name('admin.update-family');
    Route::delete('delete-family/{id}', [FamilyController::class, 'delete_family'])->name('admin.delete-family');

    /*aupairs*/
    Route::get('candidates/aupairs', [AupairsController::class, 'view_aupair_candidates'])->name('admin.candidates.aupairs');
    Route::get('candidates/edit-aupairs/{id}', [AupairsController::class, 'edit_aupair_candidate'])->name('admin.candidates.edit-aupairs');
    Route::put('candidates/update-aupairs/{id}', [AupairsController::class, 'update_aupair_candidate'])->name('admin.candidates.update-aupairs');
    Route::delete('candidates/delete-aupairs/{id}', [AupairsController::class, 'delete_aupair_candidate'])->name('admin.candidates.delete-aupairs');

    /*babysitters*/
    Route::get('candidates/babysitters', [BabysittersController::class, 'view_babysitters_candidates'])->name('admin.candidates.babysitters');
    Route::get('candidates/edit-babysitters/{id}', [BabysittersController::class, 'edit_babysitters_candidate'])->name('admin.candidates.edit-babysitters');
    Route::put('candidates/update-babysitters/{id}', [BabysittersController::class, 'update_babysitters_candidate'])->name('admin.candidates.update-babysitters');
    Route::delete('candidates/delete-babysitters/{id}', [BabysittersController::class, 'delete_babysitters_candidate'])->name('admin.candidates.delete-babysitters');

    /*petsitters*/
    Route::get('candidates/petsitters', [PetsittersController::class, 'view_petsitters_candidates'])->name('admin.candidates.petsitters');
    Route::get('candidates/edit-petsitters/{id}', [PetsittersController::class, 'edit_petsitters_candidate'])->name('admin.candidates.edit-petsitters');
    Route::put('candidates/update-petsitters/{id}', [PetsittersController::class, 'update_petsitters_candidate'])->name('admin.candidates.update-petsitters');
    Route::delete('candidates/delete-petsitters/{id}', [PetsittersController::class, 'delete_petsitters_candidate'])->name('admin.candidates.delete-petsitters');

    /*nannies*/
    Route::get('candidates/nannies', [NanniesController::class, 'view_nannies_candidates'])->name('admin.candidates.nannies');
    Route::get('candidates/edit-nannies/{id}', [NanniesController::class, 'edit_nannies_candidate'])->name('admin.candidates.edit-nannies');
    Route::put('candidates/update-nannies/{id}', [NanniesController::class, 'update_nannies_candidate'])->name('admin.candidates.update-nannies');
    Route::delete('candidates/delete-nannies/{id}', [NanniesController::class, 'delete_nannies_candidate'])->name('admin.candidates.delete-nannies');

    /*reviews*/
    Route::resource('reviews', ReviewsController::class)->names('admin.reviews');

    /*transactions*/
    Route::resource('transactions', TransactionsController::class)->names('admin.transactions');

    /*user status*/
    Route::post('change-user-status', [Controller::class, 'change_user_status'])->name('admin.change-user-status');
});