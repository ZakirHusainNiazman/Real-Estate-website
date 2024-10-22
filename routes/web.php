<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\backend\PropertyTypeController;
use App\Http\Controllers\backend\AmenitiesController;

// Route::get('/', function () {
//     return view('welcome');
// });

// user frontend all routes
Route::get('/',[UserController::class,'index']);

// user related routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard',[UserController::class,'userDashboard'])->name('dashboard');
    Route::get('/user/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'userChangePassword'])->name('user.change.password');
    Route::post('/user/change/password/store', [UserController::class, 'userUpdatePassword'])->name('user.change.password.store');
});

// admin related rotues
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');
});

Route::middleware(['auth','role:agent'])->group(function(){
Route::get('/agent/dashboard', [AdminController::class, 'agentDashboard'])->name('agent.dashboard');
});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');


require __DIR__.'/auth.php';



// admin related rotues
Route::middleware(['auth','role:admin'])->group(function(){

    // property type controller
    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/type', 'allType')->name('all.type');
        Route::get('/add/type', 'addType')->name('add.type');
        Route::post('/store/type', 'storeType')->name('store.type');
        Route::get('/edit/type/{id}', 'editType')->name('edit.type');
        Route::post('/update/type/{id}', 'updateType')->name('update.type');
        Route::get('/delete/type/{id}', 'deleteType')->name('delete.type');
    });

    // amenities routes
    Route::controller(AmenitiesController::class)->group(function(){
        Route::get('/all/amenities','allAmenities')->name('all.amenities');
        Route::get('/add/amenities','addAmenities')->name('add.amenities');
        Route::post('/store/amenities','storeAmenities')->name('store.amenities');
        Route::get('/edit/amenities/{id}','editAmenities')->name('edit.amenities');
        Route::post('/update/amenities/{id}','updateAmenities')->name('update.amenities');
        Route::get('delete/amenities/{id}','deleteAmenities')->name('delete.amenities');
    });
});
