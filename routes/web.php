<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\User\MyTicketController;
use App\Http\Controllers\User\OverviewController;
use App\Http\Controllers\User\TestimonyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\User\MyTransactionController;
use App\Http\Controllers\Admin\TravelPackageController;
use App\Http\Controllers\User\ProfileController as ProfileUserController;

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

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::post('/checkout/{id}', [CheckoutController::class, 'process'])
    ->name('checkout_process')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/{id}', [CheckoutController::class, 'index'])
    ->name('checkout')
    ->middleware(['auth', 'verified']);

Route::post('/checkout/create/{detail_id}', [CheckoutController::class, 'create'])
    ->name('checkout-create')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/remove/{detail_id}', [CheckoutController::class, 'remove'])
    ->name('checkout-remove')
    ->middleware(['auth', 'verified']);

Route::get('/checkout/confirm/{id}', [CheckoutController::class, 'success'])
    ->name('checkout-success')
    ->middleware(['auth', 'verified']);


    Route::get('/check', [CheckoutController::class, 'check'])->name('check');

Route::middleware('auth')->group(function () {
    Route::get('/overview/{username}/{id}', [OverviewController::class, 'index'])->name('overview');

    Route::get('/overview/my-ticket/{username}/{id}', [MyTicketController::class, 'index'])->name('my-ticket');
    Route::get('/my-ticket/ticket-detail/{id}', [MyTicketController::class, 'detail'])->name('ticket-detail');
    Route::get('/my-ticket/download/{id}', [MyTicketController::class, 'ticketPdf'])->name('ticket-download');

    Route::get('/overview/my-transaction/{username}/{id}', [MyTransactionController::class, 'index'])->name('my-transaction');

    Route::get('invoice/{id}', [MyTransactionController::class, 'invoice'])->name('invoice');
    Route::get('invoice-download/{id}', [MyTransactionController::class, 'invoicepdf'])->name('invoice.download');

    Route::get('/overview/settings/{username}/{id}', [SettingController::class, 'index'])->name('settings');

    Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::put('/edit-profile', [ProfileController::class, 'update'])->name('edit-profile.update');

    Route::get('/edit-password/{id}', [ProfileController::class, 'editPassword'])->name('edit-password');
    Route::post('/edit/password', [ProfileController::class, 'updatePassword'])->name('edit-password.update');

    Route::get('/testimony/create/{id}', [TestimonyController::class, 'create'])->name('testimony.create');
    Route::post('/testimony/store', [TestimonyController::class, 'store'])->name('testimony.store');
    
});


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

   Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
   Route::get('notifications-all', [NotificationController::class, 'index'])->name('notifications-all');
   Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');
});


// Auth::routes();
Route::auth(['verify' => true]);


// Midtrans
Route::post('/midtrans/callback', [MidtransController::class, 'notificationHandler']);
Route::get('/midtrans/finish', [MidtransController::class, 'finishRedirect']);
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinishRedirect']);
Route::get('/midtrans/error', [MidtransController::class, 'errorRedirect']);
