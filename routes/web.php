<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\Agent\AgentPropertyController;
use App\Http\Controllers\Agent\BuyPackageController;
use App\Http\Controllers\Agent\PackageController;
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

//_____Frontend/User Route_________
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

//_____Admin Route___________________________
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);

Route::group(['prefix'=>'admin', 'middleware' => ['auth', 'role_aux:admin']], function(){

    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('profile-update', [AdminController::class, 'adminProfileUpdate'])->name('admin.profile.update');
    Route::get('password-change', [AdminController::class, 'adminPasswordChange'])->name('admin.password.change');
    Route::post('password-update', [AdminController::class, 'adminPasswordUpdate'])->name('admin.password.update');

    //Manage Agent Section
    Route::get('all-agent', [AdminController::class, 'allAgent'])->name('all.agent')->middleware('permission:agent.all');
    Route::get('create-agent', [AdminController::class, 'createAgent'])->name('create.agent')->middleware('permission:agent.add');
    Route::post('store-agent', [AdminController::class, 'storeAgent'])->name('store.agent')->middleware('permission:agent.store');
    Route::get('destroy-agent/{id}', [AdminController::class, 'destroyAgent'])->name('destroy.agent')->middleware('permission:agent.delete');
    Route::get('change-agent-status', [AdminController::class, 'statusChangeAgent']);

    //Property-Type Section
    Route::get('type', [TypeController::class, 'index'])->name('type.index')->middleware('permission:type.all');
    Route::get('type/create', [TypeController::class, 'create'])->name('type.create')->middleware('permission:type.all');
    Route::post('type/store', [TypeController::class, 'store'])->name('type.store')->middleware('permission:type.all');
    //Propery-Amenities Section
    Route::get('amenity', [AmenityController::class, 'index'])->name('amenity.index')->middleware('permission:amenity.all');
    Route::get('amenity/create', [AmenityController::class, 'create'])->name('amenity.create')->middleware('permission:amenity.all');
    Route::post('amenity/store', [AmenityController::class, 'store'])->name('amenity.store')->middleware('permission:amenity.all');
    //Property Section
    Route::get('property', [PropertyController::class, 'index'])->name('property.index')->middleware('permission:property.all');
    Route::get('property/create', [PropertyController::class, 'create'])->name('property.create')->middleware('permission:property.all');
    Route::post('property/store', [PropertyController::class, 'store'])->name('property.store')->middleware('permission:property.all');
    Route::get('property/show/{id}', [PropertyController::class, 'show'])->name('property.show')->middleware('permission:property.all');
    //Package History Section
    Route::get('package/history', [BuyPackageController::class, 'adminPackageHistory'])->name('package.history');
    Route::get('package/package/downlaod/{id}', [BuyPackageController::class, 'adminPackageInvoiceDownload'])->name('package.invoice.downlaod');

    //Role & Permisson Section
    Route::get('all-permission', [RoleController::class, 'allPermission'])->name('all.permission')->middleware('permission:role_permission.menu');
    Route::get('add-permission', [RoleController::class, 'addPermission'])->name('add.permission')->middleware('permission:role_permission.menu');
    Route::post('store-permission', [RoleController::class, 'storePermission'])->name('store.permission')->middleware('permission:role_permission.menu');

    Route::get('all-role', [RoleController::class, 'allRole'])->name('all.role')->middleware('permission:role_permission.menu');
    Route::get('add-role', [RoleController::class, 'addRole'])->name('add.role')->middleware('permission:role_permission.menu');
    Route::post('store-role', [RoleController::class, 'storeRole'])->name('store.role')->middleware('permission:role_permission.menu');
    Route::get('delete-role/{id}', [RoleController::class, 'deleteRole'])->name('delete.role')->middleware('permission:role_permission.menu');

    Route::get('all-role-permission', [RoleController::class, 'allRolePermission'])->name('all.role.permission')->middleware('permission:role_permission.menu');
    Route::get('add-role-permission', [RoleController::class, 'addRolePermission'])->name('add.role.permission')->middleware('permission:role_permission.menu');
    Route::post('store-role-permission', [RoleController::class, 'storeRolePermission'])->name('store.role.permission')->middleware('permission:role_permission.menu');
    Route::get('edit-role-permission/{id}', [RoleController::class, 'editRolePermission'])->name('edit.role.permission')->middleware('permission:role_permission.menu');
    Route::post('update-role-permission/{id}', [RoleController::class, 'updateRolePermission'])->name('update.role.permission')->middleware('permission:role_permission.menu');
    Route::get('delete-role-permission/{id}', [RoleController::class, 'deleteRolePermission'])->name('delete.role.permission')->middleware('permission:role_permission.menu');

    //Manage Admin with Role
    Route::get('all-admin', [AdminController::class, 'allAdmin'])->name('all.admin')->middleware('permission:role_permission.menu');
    Route::get('add-admin', [AdminController::class, 'addAdmin'])->name('add.admin')->middleware('permission:role_permission.menu');
    Route::post('store-admin', [AdminController::class, 'storeAdmin'])->name('store.admin')->middleware('permission:role_permission.menu');
    Route::get('edit-admin/{id}', [AdminController::class, 'editAdmin'])->name('edit.admin')->middleware('permission:role_permission.menu');
    Route::post('update-admin/{id}', [AdminController::class, 'updateAdmin'])->name('update.admin')->middleware('permission:role_permission.menu');
    Route::get('delete-admin/{id}', [AdminController::class, 'deleteAdmin'])->name('delete.admin')->middleware('permission:role_permission.menu');
});


//_____Agent Route___________________________
Route::get('/agent/login', [AgentController::class, 'agentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register', [AgentController::class, 'agentRegister'])->name('agent.register');

Route::group(['prefix'=>'agent', 'middleware' => ['auth', 'role_aux:agent']], function(){

    Route::get('dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
    Route::get('logout', [AgentController::class, 'agentLogout'])->name('agent.logout');
    Route::get('profile', [AgentController::class, 'agentProfile'])->name('agent.profile');
    Route::post('profile-update', [AgentController::class, 'agentProfileUpdate'])->name('agent.profile.update');
    Route::get('password-change', [AgentController::class, 'agentPasswordChange'])->name('agent.password.change');
    Route::post('password-update', [AgentController::class, 'agentPasswordUpdate'])->name('agent.password.update');

    //Property Section
    Route::get('property', [AgentPropertyController::class, 'index'])->name('agent.property.index');
    Route::get('property/create', [AgentPropertyController::class, 'create'])->name('agent.property.create');
    Route::post('property/store', [AgentPropertyController::class, 'store'])->name('agent.property.store');
    //Package Section
    Route::get('package', [BuyPackageController::class, 'index'])->name('agent.buy.package');
    Route::get('business/plan', [BuyPackageController::class, 'businessPlan'])->name('agent.buy.business.plan');
    Route::post('business/plan/store', [BuyPackageController::class, 'businessPlanStore'])->name('agent.buy.business.plan.store');
    Route::get('package/history', [BuyPackageController::class, 'packageHistory'])->name('agent.package.history');
    Route::get('package/invoice/download/{id}', [BuyPackageController::class, 'packageInvoiceDownload'])->name('agent.package.invoice.downlaod');
});
