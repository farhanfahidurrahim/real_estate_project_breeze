<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//___Admin Route___
Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'role:admin']], function(){
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile-update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('password-change', [AdminController::class, 'adminPasswordChange'])->name('admin.password.change');
    Route::post('password-update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');
});


//___Agent Route___
Route::group(['prefix'=>'agent', 'middleware' => ['auth', 'role:agent']], function(){
    Route::get('dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});
