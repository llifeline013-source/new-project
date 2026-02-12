<?php
//use App\Http\Controllers\Admin\DashboardController as  AdminDashboardController;
use App\Http\Controllers\Admin\LoginAuthenticate  as AdminLoginAuthenticate;
//use App\Http\Controllers\Admin\LoginController as  AdminLoginController;
//use App\Http\Controllers\Admin\LoginController as AdminLoginController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'account'], function() {

    // Guest routes with custom middleware
     Route::group(['middleware' => 'redirect.dashboard'], function() {
     Route::get('login', [LoginController::class, 'index'])->name('account.login');
      Route::get('register', [RegisterController::class, 'index'])->name('account.register');
       Route::post('process-register', [RegisterController::class, 'processRegister'])->name('account.processRegister');
       Route::post('authenticate', [LoginController::class, 'authenticate'])->name('account.authenticate');
   });

    // Auth routes
    Route::group(['middleware' => 'auth'], function() {
        Route::post('logout', [LoginController::class, 'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('account.dashboard');
   });

});
      //  Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('account.login');

      //  Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
       // Route::post('admin/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
            use App\Http\Controllers\Admin\LoginController as AdminLoginController;
            use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

       Route::prefix('admin')->group(function () {

    // login page
    Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login');

    // login form submit
    Route::post('/authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');

    // dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // logout
    Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

});
