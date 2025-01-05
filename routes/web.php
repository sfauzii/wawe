<?php

use App\Models\TravelPackage;
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
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\User\MyTicketController;
use App\Http\Controllers\User\OverviewController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\User\TestimonyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\User\MyTransactionController;
use App\Http\Controllers\Admin\TravelPackageController;
use App\Http\Controllers\Auth\AdminsController;
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

Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials');

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

Route::get('/cancel-booking/{id}', [CheckoutController::class, 'cancelBooking'])->name('cancel-booking');

Route::middleware('auth')->group(function () {
    Route::get('/overview/{username}/{id}', [OverviewController::class, 'index'])->name('overview');

    Route::get('/overview/my-ticket/{username}/{id}', [MyTicketController::class, 'index'])->name('my-ticket');
    Route::get('/my-ticket/ticket-detail/{id}', [MyTicketController::class, 'detail'])->name('ticket-detail');
    Route::get('/my-ticket/download/{id}', [MyTicketController::class, 'ticketPdf'])->name('ticket-download');

    Route::get('/my-transaction/{username}/{id}', [MyTransactionController::class, 'index'])->name('my-transaction');

    Route::get('invoice/{id}', [MyTransactionController::class, 'invoice'])->name('invoice');
    Route::get('invoice-download/{id}', [MyTransactionController::class, 'invoicepdf'])->name('invoice.download');

    Route::get('/settings/{username}/{id}', [SettingController::class, 'index'])->name('settings');

    Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('edit-profile');
    Route::put('/edit-profile', [ProfileController::class, 'update'])->name('edit-profile.update');

    Route::get('/edit-password/{id}', [ProfileController::class, 'editPassword'])->name('edit-password');
    Route::post('/edit/password', [ProfileController::class, 'updatePassword'])->name('edit-password.update');

    Route::get('/testimony/create/{id}', [TestimonyController::class, 'create'])->name('testimony.create');
    Route::post('/testimony/store', [TestimonyController::class, 'store'])->name('testimony.store');
});



Route::get('/dashboard/login', [AdminsController::class, 'loginForm'])->name('admins-form');
Route::post('/dashboard/login', [AdminsController::class, 'login'])->name('admins-login');
Route::post('/admin-logout', [AdminsController::class, 'logoutAdmins'])->name('admin-logout');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard/{role}', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('travel-package', TravelPackageController::class);
    Route::post('/travel-package/{id}/toggle-status', [TravelPackageController::class, 'toggleStatus'])->name('travel-packages.toggleStatus');

    Route::resource('gallery', GalleryController::class);
    Route::delete('gallery/{id}/image/{index}', [GalleryController::class, 'deleteImage'])->name('gallery.delete_image');


    Route::resource('transaction', TransactionController::class);
    Route::get('transaction/invoice/{id}/print', [TransactionController::class, 'downloadPdf'])->name('transaction_print');
    Route::get('transaction/payment/{transaction}', [TransactionController::class, 'payment'])->name('transaction.payment');
    Route::get('/transaction/confirm/{id}', [TransactionController::class, 'generatePaymentUrl'])->name('transaction-success');
    Route::get('/transaction-ticket/download/{id}', [TransactionController::class, 'ticketPdf'])->name('download-ticket');

    Route::resource('user', UserController::class);

    Route::resource('roles', RoleController::class);
    Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionsToRole'])->name('roles.give-permission');
    Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionsToRole'])->name('roles.update-permission');

    Route::resource('permissions', PermissionController::class);


    Route::get('report-transaction', [ReportController::class, 'showFormTransaction'])->name('report-transaction');
    Route::get('report-transaction/download', [ReportController::class, 'generatePDF'])->name('report-transaction-download');
    Route::get('report-transaction/export-excel', [ReportController::class, 'genereteTransactionExcel'])->name('report-transaction-excel');

    Route::get('report-travel-package', [ReportController::class, 'showFormPackage'])->name('report-travel-package');

    Route::get('report-travel-package/download', [ReportController::class, 'generatePackagePDF'])->name('report-travel-package-download');
    Route::get('/report/travel-package/excel', [ReportController::class, 'generatePackageExcel'])
        ->name('report-travel-package-excel');
    // Route::get('/report/travel-package/{package_id}/customer/{user_id}/details/pdf', [ReportController::class, 'generatePackageDetailsPdfByUser'])->name('report.package.details.customer.pdf');
    // Route::get('/report/package/details/customer/excel/{package_id}/{user_id}', [ReportController::class, 'generatePackageDetailsExcelByUser'])->name('report.package.details.customer.excel');

    Route::get('/report/transactions/{id}/excel', [ReportController::class, 'generateTransactionDetailsExcel'])
        ->name('report-package-details-excel');

    Route::get('/report/transaction/{transaction_id}/pdf', [ReportController::class, 'generateTransactionDetailsPdf'])
        ->name('report.transaction.details.pdf');



    Route::post('notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
    Route::get('notifications-all', [NotificationController::class, 'index'])->name('notifications-all');
    Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

    Route::resource('carousels', CarouselController::class);
    Route::post('/carousels/{id}/toggle-status', [CarouselController::class, 'toggleStatus'])->name('carousels.toggleStatus');
});


// Auth::routes();
Route::auth(['verify' => true]);

// Socialite
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('socialite.callback');


// Midtrans
Route::post('/midtrans/callback', [MidtransController::class, 'notificationHandler']);
Route::get('/midtrans/finish', [MidtransController::class, 'finishRedirect']);
Route::get('/midtrans/unfinish', [MidtransController::class, 'unfinishRedirect']);
Route::get('/midtrans/error', [MidtransController::class, 'errorRedirect']);
