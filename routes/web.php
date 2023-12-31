<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Selvah\Models\User;

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
| Route for testing E-mail directly in web browser.
|--------------------------------------------------------------------------
*/
/*Route::get('mail', function () {
    $user = User::find(1);

    return (new \Selvah\Notifications\Auth\RegisteredNotification($user))
                ->toMail($user);
});*/

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

    // Password Reset Routes
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')
        ->name('auth.password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')
        ->name('auth.password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('auth.password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')
        ->name('auth.password.update');
    Route::get('password/setup/{id}/{hash}', 'PasswordController@showSetupForm')
        ->name('auth.password.setup');
    Route::post('password/setup/{id}/{hash}', 'PasswordController@setup')
        ->name('auth.password.create');
    Route::get('password/resend', 'PasswordController@showResendRequestForm')
        ->name('auth.password.resend.request');
    Route::post('password/resend', 'PasswordController@resend')
        ->name('auth.password.resend');
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
    | Profile Routes
    |--------------------------------------------------------------------------
    */
    Route::get('profile', [Selvah\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

    /*
    |--------------------------------------------------------------------------
    | Password Routes
    |--------------------------------------------------------------------------
    */
    Route::put('password', [Selvah\Http\Controllers\PasswordController::class, 'update'])->name('password.update');

    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::get('/', [Selvah\Http\Controllers\DashboardController::class, 'index'])
        ->name('dashboard.index');

    /*
    |--------------------------------------------------------------------------
    | Calendars Routes
    |--------------------------------------------------------------------------
    */
    Route::get('calendars', [Selvah\Http\Controllers\CalendarController::class, 'index'])
        ->name('calendars.index');

    /*
    |--------------------------------------------------------------------------
    | Notifications Routes
    |--------------------------------------------------------------------------
    */
    Route::get('api/notifications', [Selvah\Http\Controllers\API\NotificationController::class,'index'])
        ->name('notifications.index');
    Route::post(
        'api/notifications/markAsRead',
        [Selvah\Http\Controllers\API\NotificationController::class,'markAsRead']
    )->name('notifications.markasread');
    Route::post(
        'api/notifications/markAllAsRead',
        [Selvah\Http\Controllers\API\NotificationController::class, 'markAllAsRead']
    )->name('notifications.markallasread');
    Route::delete(
        'api/notifications/delete/{slug?}',
        [Selvah\Http\Controllers\API\NotificationController::class, 'delete']
    )->name('notifications.delete');

    /*
    |--------------------------------------------------------------------------
    | Incidents Routes
    |--------------------------------------------------------------------------
    */
    Route::get('incidents', [Selvah\Http\Controllers\IncidentController::class, 'index'])
        ->name('incidents.index');

    /*
    |--------------------------------------------------------------------------
    | Cleanings Routes
    |--------------------------------------------------------------------------
    */
    Route::get('cleanings', [Selvah\Http\Controllers\CleaningController::class, 'index'])
        ->name('cleanings.index');

    /*
    |--------------------------------------------------------------------------
    | Maintenances Routes
    |--------------------------------------------------------------------------
    */
    Route::get('maintenances', [Selvah\Http\Controllers\MaintenanceController::class, 'index'])
        ->name('maintenances.index');
    Route::get('maintenances/{maintenance}', [Selvah\Http\Controllers\MaintenanceController::class, 'show'])
        ->name('maintenances.show')
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
        ->name('companies.index');
    Route::get('companies/{company}', [Selvah\Http\Controllers\CompanyController::class, 'show'])
        ->name('companies.show')
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
        ->name('lots.index');

    /*
    |--------------------------------------------------------------------------
    | Zones Routes
    |--------------------------------------------------------------------------
    */
    Route::get('zones', [Selvah\Http\Controllers\ZoneController::class, 'index'])
        ->name('zones.index');

    /*
    |--------------------------------------------------------------------------
    | Parts Routes
    |--------------------------------------------------------------------------
    */
    Route::get('parts', [Selvah\Http\Controllers\PartController::class, 'index'])
        ->name('parts.index');
    Route::get('parts/{part}', [Selvah\Http\Controllers\PartController::class, 'show'])
        ->name('parts.show')
        ->missing(function (Request $request) {
            return Redirect::back()
                ->with('danger', "Cette pièce détachée n'existe pas ou à été supprimée !");
        });

    /*
    |--------------------------------------------------------------------------
    | PartEntries Routes
    |--------------------------------------------------------------------------
    */
    Route::get('part-entries', [Selvah\Http\Controllers\PartEntryController::class, 'index'])
        ->name('part-entries.index');

    /*
    |--------------------------------------------------------------------------
    | PartExits Routes
    |--------------------------------------------------------------------------
    */
    Route::get('part-exits', [Selvah\Http\Controllers\PartExitController::class, 'index'])
        ->name('part-exits.index');

    /*
    |--------------------------------------------------------------------------
    | Materials Routes
    |--------------------------------------------------------------------------
    */
    Route::get('materials', [Selvah\Http\Controllers\MaterialController::class, 'index'])
        ->name('materials.index');
    Route::get('materials/{material}', [Selvah\Http\Controllers\MaterialController::class, 'show'])
        ->name('materials.show')
        ->missing(function (Request $request) {
            return Redirect::back()
                ->with('danger', "Ce matériel n'existe pas ou à été supprimé !");
        });

    /*
    |--------------------------------------------------------------------------
    | Users Routes
    |--------------------------------------------------------------------------
    */
    Route::get('users', [Selvah\Http\Controllers\UserController::class, 'index'])
        ->name('users.index');

    /*
    |--------------------------------------------------------------------------
    | Roles/Permissions Routes
    |--------------------------------------------------------------------------
    */
    Route::group(['namespace' => 'Role', 'prefix' => 'roles'], function () {

        // Roles Routes
        Route::get('roles', [Selvah\Http\Controllers\Role\RoleController::class, 'index'])
            ->name('roles.roles.index');

        // Permissions Route
        Route::get('permissions', [Selvah\Http\Controllers\Role\PermissionController::class, 'index'])
            ->name('roles.permissions.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::get('settings', [Selvah\Http\Controllers\SettingController::class, 'index'])
        ->name('settings.index');
});
