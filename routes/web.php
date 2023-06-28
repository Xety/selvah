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

Route::get('/', [Selvah\Http\Controllers\HomeController::class, 'index'])->name('home');

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
| User Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'namespace' => 'User',
    'prefix' => 'user',
    'middleware' => ['permission:manage.users']
], function () {

    // User Routes
    Route::get('/', 'UserController@index')->name('user.user.index');
    Route::get('search', 'UserController@search')->name('user.user.search');

    Route::get('update/{slug}.{id}', 'UserController@showUpdateForm')
        ->name('user.user.edit');
    Route::put('update/{id}', 'UserController@update')
        ->name('user.user.update');

    Route::delete('delete/{id}', 'UserController@delete')
        ->name('user.user.delete');

    Route::delete('deleteAvatar/{id}', 'UserController@deleteAvatar')
        ->name('user.user.deleteavatar');
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
    'middleware' => ['permission:manage.settings']
], function () {

    // Settings Routes
    Route::get('settings', 'SettingController@index')->name('setting.index');

    Route::get('settings/create', 'SettingController@showCreateForm')
        ->name('setting.create');
    Route::post('settings/create', 'SettingController@create')
        ->name('setting.create');

    Route::get('settings/update/{id}', 'SettingController@showUpdateForm')
        ->name('setting.edit');
    Route::put('settings/update/{id}', 'SettingController@update')
        ->name('setting.update');

    Route::delete('settings/delete/{id}', 'SettingController@delete')
        ->name('setting.delete');
});
