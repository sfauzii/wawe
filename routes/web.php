<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TravelPackageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DetailController;

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
//     return view('pages.home');
// });

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/details/{slug}', [DetailController::class, 'index'])->name('details');

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard');

   Route::resource('travel-package', TravelPackageController::class);
   Route::resource('gallery', GalleryController::class);
   Route::resource('transaction', TransactionController::class);
   Route::resource('user', UserController::class);

   Route::resource('roles', RoleController::class);
   Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionsToRole'])->name('roles.give-permission');
   Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionsToRole'])->name('roles.update-permission');

   Route::resource('permissions', PermissionController::class);


   Route::get('report-transaction', [ReportController::class, 'showFormTransaction'])->name('report-transaction');
   Route::get('report-transaction/download', [ReportController::class, 'generatePDF'])->name('report-transaction-download');

   Route::get('report-travel-package', [ReportController::class, 'showFormPackage'])->name('report-travel-package');
   
   Route::get('report-travel-package/download', [ReportController::class, 'generatePackagePDF'])->name('report-travel-package-download');
});


// Auth::routes();
Route::auth(['verify' => true]);


