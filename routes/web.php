<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\RoleController;
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
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//___Frontend/User Route___
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
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile-update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('password-change', [AdminController::class, 'adminPasswordChange'])->name('admin.password.change');
    Route::post('password-update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');
    //Manage Agent Section
    Route::get('all-agent', [AdminController::class, 'allAgent'])->name('all.agent');
    Route::get('create-agent', [AdminController::class, 'createAgent'])->name('create.agent');
    Route::post('store-agent', [AdminController::class, 'storeAgent'])->name('store.agent');
    Route::get('destroy-agent/{id}', [AdminController::class, 'destroyAgent'])->name('destroy.agent');
    Route::get('change-agent-status', [AdminController::class, 'statusChangeAgent']);
    //ProperyType Section
    Route::resource('property-type', PropertyTypeController::class);
    //ProperyAmenities Section
    Route::resource('amenities', AmenityController::class);
    //Property Section
    Route::resource('property', PropertyController::class);
    //Role & Permisson Section
    Route::get('all-permission', [RoleController::class, 'allPermission'])->name('all.permission');
    Route::get('add-permission', [RoleController::class, 'addPermission'])->name('add.permission');
    Route::post('store-permission', [RoleController::class, 'storePermission'])->name('store.permission');

    Route::get('all-role', [RoleController::class, 'allRole'])->name('all.role');
    Route::get('add-role', [RoleController::class, 'addRole'])->name('add.role');
    Route::post('store-role', [RoleController::class, 'storeRole'])->name('store.role');
    Route::get('all-role-permission', [RoleController::class, 'allRolePermission'])->name('all.role.permission');
    Route::get('add-role-permission', [RoleController::class, 'addRolePermission'])->name('add.role.permission');
    Route::post('store-role-permission', [RoleController::class, 'storeRolePermission'])->name('store.role.permission');
});


//___Agent Route___
Route::get('/agent/login', [AgentController::class, 'agentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'agentRegister'])->name('agent.register');
Route::group(['prefix'=>'agent', 'middleware' => ['auth', 'role:agent']], function(){
    Route::get('dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
    Route::get('logout', [AgentController::class, 'agentLogout'])->name('agent.logout');
    Route::get('profile', [AgentController::class, 'agentProfile'])->name('agent.profile');
    Route::post('profile-update', [AgentController::class, 'agentProfileUpdate'])->name('agent.profile.update');
    Route::get('password-change', [AgentController::class, 'agentPasswordChange'])->name('agent.password.change');
    Route::post('password-update', [AgentController::class, 'agentPasswordUpdate'])->name('agent.password.update');
});
