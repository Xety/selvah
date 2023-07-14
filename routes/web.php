<?php

use Illuminate\Http\Request;
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
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {
    // Incidents Routes
    Route::get('incidents', [Selvah\Http\Controllers\IncidentController::class, 'index'])
        ->name('incident.index');

    // Maintenances Routes
    Route::get('maintenances', [Selvah\Http\Controllers\MaintenanceController::class, 'index'])
        ->name('maintenance.index');
    Route::get('maintenances/{maintenance}', [Selvah\Http\Controllers\MaintenanceController::class, 'show'])
        ->name('maintenance.show')
        ->missing(function (Request $request) {
            return Redirect::back()
                ->with('danger', "Cette maintenance n'existe pas ou à été supprimée !");
        });
});

/*
|--------------------------------------------------------------------------
| Zones Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'permission:Gérer les Zones']], function () {
    // Zones Routes
    Route::get('zones', [Selvah\Http\Controllers\ZoneController::class, 'index'])->name('zone.index');
});

/*
|--------------------------------------------------------------------------
| Parts Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'permission:Gérer les Pièces']], function () {
    // Parts Routes
    Route::get('parts', [Selvah\Http\Controllers\PartController::class, 'index'])->name('part.index');

    Route::get('parts/{slug}.{id}', [Selvah\Http\Controllers\PartController::class, 'show'])
        ->name('part.show');

    // PartEntries Routes
    Route::get('part-entry', [Selvah\Http\Controllers\PartEntryController::class, 'index'])->name('part-entry.index');

    // PartExits Routes
    Route::get('part-exit', [Selvah\Http\Controllers\PartExitController::class, 'index'])->name('part-exit.index');
});

/*
|--------------------------------------------------------------------------
| Materials Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'permission:Gérer les Matériels']], function () {

    Route::get('materials', [Selvah\Http\Controllers\MaterialController::class, 'index'])->name('material.index');

    Route::get('materials/{slug}.{id}', [Selvah\Http\Controllers\MaterialController::class, 'show'])
        ->name('material.show');
});

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'permission:Gérer les Utilisateurs']], function () {
    // User Routes
    Route::get('users', [Selvah\Http\Controllers\UserController::class, 'index'])->name('user.index');
});

/*
|--------------------------------------------------------------------------
| Roles/Permissions Routes
|--------------------------------------------------------------------------
*/
Route::group([
    'namespace' => 'role',
    'prefix' => 'roles',
    'middleware' => ['auth', 'permission:Gérer les Rôles']
], function () {

    // Role Routes
    Route::get('role', 'RoleController@index')->name('role.role.index');

    // Permission Route
    Route::get('permission', 'PermissionController@index')->name('role.permission.index');
});

/*
|--------------------------------------------------------------------------
| Settings Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'permission:Gérer les Paramètres']], function () {
    // Settings Routes
    Route::get('settings', 'SettingController@index')->name('setting.index');
});
