<?php

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

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes
    Route::get('login', 'LoginController@showLoginForm')->name('auth.login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('auth.logout');
});

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'permission:Accéder au Site']], function () {
    Route::get('/', [Selvah\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});

/*
|--------------------------------------------------------------------------
| Zones Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'prefix' => 'zones',
    'middleware' => ['auth', 'permission:Gérer les Utilisateurs']
], function () {

    // Zones Routes
    Route::get('/', 'UserController@index')->name('user.user.index');
    Route::get('search', 'UserController@search')->name('user.user.search');

    Route::get('update/{slug}.{id}', 'UserController@showUpdateForm')
        ->name('user.user.edit');
    Route::put('update/{id}', 'UserController@update')
        ->name('user.user.update');
});


/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'namespace' => 'User',
    'prefix' => 'user',
    'middleware' => ['auth', 'permission:Gérer les Utilisateurs']
], function () {

    // User Routes
    Route::get('/', 'UserController@index')->name('user.user.index');
    Route::get('search', 'UserController@search')->name('user.user.search');

    Route::get('update/{slug}.{id}', 'UserController@showUpdateForm')
        ->name('user.user.edit');
    Route::put('update/{id}', 'UserController@update')
        ->name('user.user.update');
});

/*
|--------------------------------------------------------------------------
| Role Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'namespace' => 'Role',
    'prefix' => 'role',
    'middleware' => ['permission:manage.roles']
], function () {

    // Role Routes
    Route::get('role', 'RoleController@index')->name('role.role.index');

    Route::get('role/create', 'RoleController@showCreateForm')
        ->name('role.role.create');
    Route::post('role/create', 'RoleController@create')
        ->name('role.role.create');

    Route::get('role/update/{id}', 'RoleController@showUpdateForm')
        ->name('role.role.edit');
    Route::put('role/update/{id}', 'RoleController@update')
        ->name('role.role.update');

    Route::delete('role/delete/{id}', 'RoleController@delete')
        ->name('role.role.delete');

    // Permission Route
    Route::get('permission', 'PermissionController@index')->name('role.permission.index');

    Route::get('permission/create', 'PermissionController@showCreateForm')
        ->name('role.permission.create');
    Route::post('permission/create', 'PermissionController@create')
        ->name('role.permission.create');

    Route::get('permission/update/{id}', 'PermissionController@showUpdateForm')
        ->name('role.permission.edit');
    Route::put('permission/update/{id}', 'PermissionController@update')
        ->name('role.permission.update');

    Route::delete('permission/delete/{id}', 'PermissionController@delete')
        ->name('role.permission.delete');
});

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'middleware' => ['auth', 'permission:Gérer les Paramètres']
], function () {

    // Settings Routes
    Route::get('settings', 'SettingController@index')->name('setting.index');
});
