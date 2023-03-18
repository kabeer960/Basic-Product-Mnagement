<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function(){
    return view('home');
})->name('home');


Route::get('/products', [ProductsController::class, 'showproducts'])->name('products');
Route::get('order/card/{id}', [OrderController::class, 'productcard']);
Route::post('order/store', [OrderController::class, 'orderstore']);
Route::get('myorders', [OrderController::class, 'myorders'])->name('myorders');
Route::get('myorder/cancel/{id}', [OrderController::class, 'myorder_cancel']);
Route::get('myorder/reorder/{id}', [OrderController::class, 'myorder_reorder']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardsController::class, 'index'])->name('dashboard');
    Route::get('/manageproducts', [ProductsController::class, 'index'])->name('manageproducts');
    Route::post('/manageproducts', [ProductsController::class, 'store']);
    Route::get('/manageproduct/edit/{id}', [ProductsController::class, 'edit']);
    Route::delete('manageproduct/delete/{id}', [ProductsController::class, 'delete']);

    Route::get('/manageorders', [OrderController::class, 'manageorders'])->name('manageorders');
    Route::get('/pendingorders', [OrderController::class, 'pendingorders'])->name('pendingorders');
    Route::get('/inprogressorders', [OrderController::class, 'inprogressorders'])->name('inprogressorders');
    Route::get('/shippedorders', [OrderController::class, 'shippedorders'])->name('shippedorders');
    Route::get('/deliveredorders', [OrderController::class, 'deliveredorders'])->name('deliveredorders');
    Route::get('/canceledorders', [OrderController::class, 'canceledorders'])->name('canceledorders');

    Route::get('/pendingorders/{id}', [OrderController::class, 'cit_progress']);
    Route::get('pendingorders/cancel/{id}', [OrderController::class, 'cit_cancel']);
    Route::get('/inprogressorders/{id}', [OrderController::class, 'cit_shipped']);
    Route::get('/deliveredorders/{id}', [OrderController::class, 'cit_delivered']);

    Route::get('manageusers', [UserController::class, 'manageusers'])->name('manageusers');
    Route::get('manageusers/{id}', [UserController::class, 'get_userdata']);
    Route::post('manageusers', [UserController::class, 'user_edit_store']);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
