<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Redirect;
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

// Route::get('/', function () {
//     return view('welcome');
// });

//___Frontend Route___
Route::get('/', [UserController::class, 'index']);
Route::get('/sign-in', [UserController::class, 'signIn'])->name('signin');

Route::get('/dashboard', function (){ return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['prefix'=>'user', 'middleware' => 'auth'], function(){
    Route::get('profile-edit', [UserController::class, 'editUserProfile'])->name('user.profile.edit');
    Route::post('profile-update', [UserController::class, 'updateUserProfile'])->name('user.profile.update');
    Route::get('logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('password-change', [UserController::class, 'userPasswordChange'])->name('user.password.change');
    Route::post('password-update', [UserController::class, 'userPasswordUpdate'])->name('user.password.update');
});


require __DIR__.'/auth.php';

//___Admin Route___
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile-update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('password-change', [AdminController::class, 'adminPasswordChange'])->name('admin.password.change');
    Route::post('password-update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');
});


//___Agent Route___
Route::get('/agent/login', [AgentController::class, 'agentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'agentRegister'])->name('agent.register');

Route::group(['prefix'=>'agent', 'middleware' => ['auth', 'role:agent']], function(){
    Route::get('dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
    Route::get('logout', [AgentController::class, 'agentLogout'])->name('agent.logout');
    Route::get('profile', [AgentController::class, 'agentProfile'])->name('agent.profile');
    Route::post('profile-update', [AgentController::class, 'agentProfileUpdate'])->name('agent.profile.update');
});
