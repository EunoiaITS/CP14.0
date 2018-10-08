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

/**
 * Frontend area
*/


Route::get('/', 'Frontend@home')->name('home');
Route::get('/join', 'Authenticate@join');
Route::get('/sign-up/success', 'Authenticate@success');
Route::get('/sign-up/driver', 'Authenticate@registerDriver');
Route::post('/sign-up/driver', 'Authenticate@registerDriver');
Route::get('/sign-up/customer', 'Authenticate@registerCustomer');
Route::post('/sign-up/customer', 'Authenticate@registerCustomer');
Route::get('/popular/{opt}', 'Frontend@popular');
Route::get('/ride-details/{link}', 'Frontend@rideDetails');
Route::post('/guest-requests', 'Frontend@guestRequests');
Route::post('/request-ride', 'Frontend@riderRequest');
Route::post('/guest-ride-requests', 'Frontend@guestRideRequest');
Route::get('/search', 'Frontend@search');
Route::post('/search', 'Frontend@search');
Route::get('/about-us', 'Frontend@aboutUs');
Route::get('/terms', 'Frontend@terms');
Route::get('/contact-us', 'Frontend@contactUs');
Route::get('/copyright', 'Frontend@copyright');
Route::get('/non-discrimination', 'Frontend@nonDiscrimination');
Route::get('/privacy-policy', 'Frontend@privacyPolicy');
Route::get('/how-it-works', 'Frontend@howItWorks');
Route::get('/choose-country', 'Frontend@chooseCountry');
Route::post('/choose-country', 'Frontend@chooseCountry');
Route::post('/read-notification', 'Frontend@readNotification');
Route::get('/account/user/verify', 'Frontend@verifyUser');
Route::get('/login/admin', 'Frontend@login');
Route::get('/profile/ridemate', 'Frontend@ridemateProfile');
Route::get('/hit', function(){
    event(new \App\Events\OfferCreated([
        'event' => 'ride-test',
        'msg' => 'Mahmud Abdur Rahman is testing the system.',
        'tos' => [10 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9]
    ]));
    return 'Event was fired!!';
});

/* ------------------------------------------------------ */

/**
 * Admin area
*/
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Admin@login');
    Route::get('/', 'Admin@dashboard');
    Route::get('/create-admin', 'Admin@createAdmin');
    Route::post('/create-admin', 'Admin@createAdmin');
    Route::get('/list', 'Admin@adminList');
    Route::post('/list', 'Admin@adminList');
    Route::post('/user/delete/{id}', 'Admin@deleteUser');
    Route::get('/drivers', 'Admin@driverList');
    Route::get('/create-driver', 'Admin@createDriver');
    Route::post('/create-driver', 'Admin@createDriver');
    Route::get('/customers', 'Admin@customerList');
    Route::get('/create-customers', 'Admin@createCustomer');
    Route::post('/create-customers', 'Admin@createCustomer');
    Route::get('/rides', 'Admin@rideDetails');
    Route::post('/rides', 'Admin@rideDetails');
    Route::get('/customers/view/{id}', 'Admin@viewCustomer');
    Route::get('/drivers/view/{id}', 'Admin@viewDriver');
    Route::get('/income-statement/', 'Admin@incomeStatement');
    Route::get('/total-income/', 'Admin@totalIncome');
    Route::post('/block/', 'Admin@block');
    Route::post('/unblock/', 'Admin@unblock');
});

/* ------------------------------------------------------ */


/**
 * Customer area
 */
Route::prefix('c')->group(function(){
    Route::get('/profile', 'Customer@viewProfile');
    Route::get('/profile/edit', 'Customer@editProfile');
    Route::post('/profile/edit', 'Customer@editProfile');
    Route::post('/profile/edit/password/{id}', 'Customer@editPassword');
    Route::post('/profile/edit/image', 'Customer@imageUpload');
    Route::get('/ride-details/{link}', 'Customer@rideDetails');
    Route::get('/search', 'Customer@search');
    Route::post('/search', 'Customer@search');
    Route::get('/bookings', 'Customer@bookings');
    Route::post('/book-ride', 'Customer@bookRide');
    Route::post('/cancel-book', 'Customer@cancelBooking');
    Route::post('/ride-request', 'Customer@rideRequest');
    Route::get('/requests', 'Customer@rideRequests');
    Route::post('/delete-request', 'Customer@deleteRequest');
    Route::get('/notifications', 'Customer@notifications');
    Route::get('/rate/{link}', 'Customer@rate');
    Route::post('/rate/{link}', 'Customer@rate');
    Route::get('/history', 'Customer@history');
});

/**
 * Driver area
 */
Route::prefix('d')->group(function(){
    Route::get('/profile', 'Driver@viewProfile');
    Route::get('/profile/edit', 'Driver@editProfile');
    Route::post('/profile/edit', 'Driver@editProfile');
    Route::post('/profile/edit/password', 'Driver@editPassword');
    Route::post('/profile/edit/image', 'Driver@imageUpload');
    Route::get('/offer-ride', 'Driver@offerRide');
    Route::post('/offer-ride', 'Driver@offerRide');
    Route::get('/active-offers', 'Driver@myOffers');
    Route::get ('/ride-details/{link}', 'Driver@rideDetails');
    Route::post ('/ride-details/{link}', ['as' => 'ride_details', 'uses' => 'Driver@rideDetails']);
    Route::get('/edit-ride/{id}', 'Driver@editRide');
    Route::post('/edit-ride/{id}', 'Driver@editRide');
    Route::post('/confirm-bookings', 'Driver@confirmBookings');
    Route::post('/cancel-bookings', 'Driver@cancelBookings');
    Route::post('/start-ride', 'Driver@startRide');
    Route::post('/end-ride', 'Driver@endRide');
    Route::get('/ride-requests', 'Driver@rideRequests');
    Route::post('/income-statement/', 'Driver@incomeStatement');
    Route::get('/notifications', 'Driver@notifications');
    Route::get('/history', 'Driver@history');
    Route::post('/rate/{link}', 'Driver@rate');
});

/**
 * Auth routes
*/
Auth::routes();

