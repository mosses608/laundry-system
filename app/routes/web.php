<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'home_page'])->name('/login');

Route::get('/dashboard', [Controller::class, 'dashboard'])->middleware('auth');

Route::get('/laundry-list', [Controller::class, 'laundry_list'])->middleware('auth');

Route::post('/laundries', [Controller::class, 'store_laundry_records']);

Route::put('/laundries/editlaundry/{laundry}', [Controller::class, 'update_records'])->middleware('auth');

Route::get('/single-list/{laundry}', [Controller::class, 'find_single'])->middleware('auth');

Route::delete('/delete/{laundry}', [Controller::class, 'delete_record']);

Route::get('/laundry-category', [Controller::class, 'category'])->middleware('auth');

Route::post('/categories', [Controller::class, 'store_category'])->middleware('auth');

Route::delete('/deletecategory/{category}', [Controller::class, 'delete_category'])->middleware('auth');

Route::get('/inventory', [Controller::class, 'go_inventory'])->middleware('auth');

Route::post('/supplies', [Controller::class, 'store_supply_records'])->middleware('auth');

Route::delete('/delete/supply/{supply}', [Controller::class, 'delete_supply_record'])->middleware('auth');

Route::get('/generate-report', [Controller::class, 'generate_report'])->middleware('auth');

Route::get('/user-management', [Controller::class, 'user_management'])->middleware('auth');

Route::post('/users', [Controller::class, 'store_users'])->middleware('auth');

Route::get('/view-actions/{user}', [Controller::class, 'single_user'])->middleware('auth');

Route::put('/users/edit/{user}', [Controller::class, 'update_users'])->middleware('auth');

Route::delete('/users/delete/{user}', [Controller::class, 'delete_user'])->middleware('auth');

Route::post('/authenticate', [Controller::class, 'authenticate_user']);

Route::post('/logout', [Controller::class, 'logout_user'])->middleware('auth');

Route::get('/post-news', [Controller::class, 'show_post_news'])->middleware('auth');

Route::post('/updates', [Controller::class, 'post_news'])->middleware('auth');

//CUSTOMER ROUTES
Route::get('/customers/dashboard', [Controller::class, 'customer_dashboard']);

Route::get('/customers/my-profile', [Controller::class, 'my_profile']);

Route::get('/customers/place-order', [Controller::class, 'place_order']);

Route::get('/customers/my-list/{laundry}', [Controller::class, 'show_single_item']);

Route::put('/laundries/my_laundry/{laundry}', [Controller::class, 'edit_my_laundry']);

Route::get('/customers/order-history', [Controller::class, 'order_history']);

Route::get('/register', [Controller::class, 'register']);

Route::post('/customers', [Controller::class, 'store_customers']);

Route::put('/customers/editdata/{customer}', [Controller::class, 'edit_customer_data']);
