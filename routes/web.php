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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user', [App\Http\Controllers\Users::class, 'index'])->name('user');
Route::get('/user/changepassword', [App\Http\Controllers\Users::class, 'changepassword'])->name('user.changePassword');
Route::get('/user/changeDetails', [App\Http\Controllers\Users::class, 'changeDetails'])->name('user.changeDeatils'); //AJAX
Route::get('/user/updateDetails', [App\Http\Controllers\Users::class, 'updateDetails'])->name('user.updateDetails'); //AJAX
Route::get('/user/updatePassword', [App\Http\Controllers\Users::class, 'updatePassword'])->name('user.updatePassword');
Route::get('/user/addUser', [App\Http\Controllers\Users::class, 'addUser'])->name('user.addUser');


//Account Routes
Route::get('/account/index', [App\Http\Controllers\AccountController::class, 'index'])->name('Account.index');
Route::get('/account/create', [App\Http\Controllers\AccountController::class, 'create'])->name('account.create');
Route::post('/account/add', [App\Http\Controllers\AccountController::class, 'add'])->name('Account.add');
Route::get('/account/edit/{id}', [App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
Route::post('/account/update/{id}', [App\Http\Controllers\AccountController::class, 'update'])->name('account.update');
Route::get('/account/view/{id}', [App\Http\Controllers\AccountController::class, 'view'])->name('account.view');
Route::delete('/account/delete/{id}', [App\Http\Controllers\AccountController::class, 'delete'])->name('account.delete');


//