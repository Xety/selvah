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
| Auth Namespace
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Auth'], function () {
    // Authentication Routes
    Route::get('login', [Selvah\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])
        ->name('auth.login');
    Route::post('login', [Selvah\Http\Controllers\Auth\LoginController::class, 'login']);
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth']], function () {
    /*
    |--------------------------------------------------------------------------
    | Authentication Routes
    |--------------------------------------------------------------------------
    */
    Route::post('logout', [Selvah\Http\Controllers\Auth\LoginController::class, 'logout'])
        ->name('auth.logout');

    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/', [Selvah\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard.index');

    /*
    |--------------------------------------------------------------------------
    | Incidents Routes
    |--------------------------------------------------------------------------
    */
    Route::get('incidents', [Selvah\Http\Controllers\IncidentController::class, 'index'])
        ->name('incident.index');

    /*
    |--------------------------------------------------------------------------
    | Maintenances Routes
    |--------------------------------------------------------------------------
    */
    Route::get('maintenances', [Selvah\Http\Controllers\MaintenanceController::class, 'index'])
        ->name('maintenance.index');
    Route::get('maintenances/{maintenance}', [Selvah\Http\Controllers\MaintenanceController::class, 'show'])
        ->name('maintenance.show')
        ->missing(function (Request $request) {
            return Redirect::back()
                ->with('danger', "Cette maintenance n'existe pas ou à été supprimée !");
        });

    /*
    |--------------------------------------------------------------------------
    | Companies Routes
    |--------------------------------------------------------------------------
    */
    Route::get('companies', [Selvah\Http\Controllers\CompanyController::class, 'index'])
        ->name('company.index');
    Route::get('companies/{company}', [Selvah\Http\Controllers\CompanyController::class, 'show'])
        ->name('company.show')
        ->missing(function (Request $request) {
            return Redirect::back()
                ->with('danger', "Cette entreprise n'existe pas ou à été supprimée !");
        });

    /*
    |--------------------------------------------------------------------------
    | Lots Routes
    |--------------------------------------------------------------------------
    */
    Route::get('lots', [Selvah\Http\Controllers\LotController::class, 'index'])
        ->name('lot.index');

    /*
    |--------------------------------------------------------------------------
    | Zones Routes
    |--------------------------------------------------------------------------
    */
    Route::get('zones', [Selvah\Http\Controllers\ZoneController::class, 'index'])
        ->name('zone.index');

    /*
    |--------------------------------------------------------------------------
    | Parts Routes
    |--------------------------------------------------------------------------
    */
    Route::get('parts', [Selvah\Http\Controllers\PartController::class, 'index'])
        ->name('part.index');

    Route::get('parts/{slug}.{id}', [Selvah\Http\Controllers\PartController::class, 'show'])
        ->name('part.show');

    /*
    |--------------------------------------------------------------------------
    | PartEntries Routes
    |--------------------------------------------------------------------------
    */
    Route::get('part-entry', [Selvah\Http\Controllers\PartEntryController::class, 'index'])
        ->name('part-entry.index');

    /*
    |--------------------------------------------------------------------------
    | PartExits Routes
    |--------------------------------------------------------------------------
    */
    Route::get('part-exit', [Selvah\Http\Controllers\PartExitController::class, 'index'])
        ->name('part-exit.index');

    /*
    |--------------------------------------------------------------------------
    | Materials Routes
    |--------------------------------------------------------------------------
    */
    Route::get('materials', [Selvah\Http\Controllers\MaterialController::class, 'index'])
        ->name('material.index');
    Route::get('materials/{slug}.{id}', [Selvah\Http\Controllers\MaterialController::class, 'show'])
        ->name('material.show');

    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */
    Route::get('users', [Selvah\Http\Controllers\UserController::class, 'index'])
        ->name('user.index');

    /*
    |--------------------------------------------------------------------------
    | Roles/Permissions Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['namespace' => 'Role', 'prefix' => 'roles'], function () {

        // Roles Routes
        Route::get('roles', [Selvah\Http\Controllers\Role\RoleController::class, 'index'])
            ->name('role.role.index');

        // Permissions Route
        Route::get('permissions', [Selvah\Http\Controllers\Role\PermissionController::class, 'index'])
            ->name('role.permission.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::get('settings', [Selvah\Http\Controllers\SettingController::class, 'index'])
        ->name('setting.index');
});
