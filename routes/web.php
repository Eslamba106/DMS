<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\UserManagmentController;




// // Translation
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('lang');

// Auth 
Route::get('/', [AuthController::class , 'loginPage'])->name('login-page');
Route::post('/login' , [AuthController::class , 'login'])->name('login');
Route::get('/register-page' , [AuthController::class , 'registerPage'])->name('register-page');
Route::post('/register' , [AuthController::class , 'register'])->name('register');
Route::get('logout' , [AuthController::class , 'logout'])->middleware('auth')->name('logout');
Route::get('/forgot-password', [AuthController::class , 'forgotPassword'])->name('forgot-password');
// Dashboard 

Route::get('/dashboard' , [DashboardController::class , 'index'])->name('dashboard')->middleware('auth');

// User Managment
Route::group(['prefix' => 'user_management'], function () {

    Route::get('/' , [UserManagmentController::class , 'index'])->name('admin.user_managment');
    // Route::get('/create', [ProductController::class , 'create'])->name('admin.products.create');
    // Route::post('/create', [ProductController::class , 'store'])->name('admin.products.store');
    // Route::get('/show/{slug}' , [ProductController::class , 'show'])->name('admin.products.show');
    // Route::get('/edit/{product}' , [ProductController::class , 'edit'])->name('admin.products.edit');
    // Route::post('/edit/{product}' , [ProductController::class , 'update'])->name('admin.products.update');
    // Route::get('/delete/{slug}', [ProductController::class ,'destroy'])->name('admin.products.delete');

});

// Roles
Route::group(['prefix' => 'admin/roles'], function () {
    Route::get('/', [RoleController::class ,'index'])->name('admin.roles');
    Route::get('/create', [RoleController::class ,'create'])->name('admin.roles.create');
    Route::post('/store', [RoleController::class ,'store'])->name('admin.roles.store');
    Route::get('/{id}/edit', [RoleController::class ,'edit'])->name('admin.roles.edit');
    Route::post('/{id}/update', [RoleController::class ,'update'])->name('admin.roles.update');
    Route::delete('/delete', [RoleController::class ,'destroy'])->name('admin.roles.delete');
});


// Settings 

Route::group(['prefix' => 'settings'], function () {

    Route::get('/' , [SettingsController::class , 'index'])->name('admin.settings');
    Route::get('/edit/{setting}' , [SettingsController::class , 'edit'])->name('admin.settings.edit');
    Route::put('/update/{setting}' , [SettingsController::class , 'update'])->name('admin.settings.update');
});


// Departments


Route::group(['prefix' => 'departments'], function () {

    Route::get('/' , [DepartmentsController::class , 'index'])->name('all_departments');
    Route::get('/create', [DepartmentsController::class ,'create'])->name('departments.create_department');
    Route::post('/create', [DepartmentsController::class ,'store'])->name('departments.store');
    Route::get('/show/{slug}' , [DepartmentsController::class , 'show'])->name('departments.show');
    Route::get('/edit/{category}' , [DepartmentsController::class , 'edit'])->name('departments.edit');
    Route::post('/edit/{category}' , [DepartmentsController::class , 'update'])->name('departments.update');
    // Route::post('update_top_departments', 'DepartmentsController@update_top_departments')->name('update_top_departments');
    Route::get('/delete/{slug}', [DepartmentsController::class ,'destroy'])->name('departments.delete');

});


// Route::get('openfiles', [FilesController::class , 'readAndEditMyFile'])->name('openfiles');

// // Route::get('openfiles' , function(){
// //     $handel = fopen('word.docx');
// //         fread($handel);
// //     fclose($handel);
// // })->name('openfiles');