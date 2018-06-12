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
Route::get('/', 'Frontend@home');
Route::get('/join', 'Authenticate@join');
Route::get('/sign-up/driver', 'Authenticate@registerDriver');
Route::get('/sign-up/customer', 'Authenticate@registerCustomer');

/* ------------------------------------------------------ */

/**
 * Admin area
*/
Route::get('/admin/login', 'Admin@login');
Route::get('/admin', 'Admin@dashboard');
Route::get('/admin/create-admin', 'Admin@createAdmin');
Route::get('/admin/list', 'Admin@adminList');
Route::get('/admin/drivers', 'Admin@driverList');
Route::get('/admin/customers', 'Admin@customerList');
Route::get('/admin/rides', 'Admin@rideDetails');
Route::get('/admin/customers/view/{id}', 'Admin@viewCustomer');
Route::get('/admin/drivers/view/{id}', 'Admin@viewDriver');

/* ------------------------------------------------------ */
