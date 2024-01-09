<?php

use App\Http\Controllers\Admin\BookingList;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\categoryController;
use App\Http\Controllers\Admin\ReservationApproval;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\VehicleEdit;
use App\Http\Controllers\Admin\VerifyCustomers;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DiscountCoupons;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchVehicleController;
use App\Http\Controllers\FavController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

// Admin Dashboard
Route::get('/adminpanel', [IndexController::class, 'AdminIndex'])->middleware(['auth', 'verified', 'role:admin'])->name('adminIndex');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Contact us
// Display the contact form
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');

// Terms and conditions
Route::get('/termsandconditions', function () {
    return view('termsAndConditions.termsAndConditions');
})->name('termsandconditions');

// Handle the form submission
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Manage
Route::get('/manageMyAccount', [ManageController::class, 'manageMyAccount'])->middleware(['auth', 'verified'])->name('manageMyAccount');
Route::get('/myReservations', [ManageController::class, 'myReservations'])->name('myReservations');
Route::get('/reservation-cancellation/{id}', [ManageController::class, 'cancelReservation'])->name('reservation.cancellation');
Route::get('/mycancellations', [ManageController::class, 'myCancellations'])->name('mycancellations');
Route::get('/myfavourite', [ManageController::class, 'myFavourite'])->name('myfavourite');
Route::get('/myprofile', [ManageController::class, 'myProfile'])->name('myprofile');
Route::get('/myNotifications', [ManageController::class, 'myNotifications'])->name('myNotifications');
Route::get('/notification-delete/{id}', [ManageController::class, 'dismissNotification'])->name('dismissNotification');
Route::get('/discount-offers', [ManageController::class, 'discountOffers'])->name('discount.offers');


// Cart
Route::get('/mycart', [CartController::class, 'cart'])->name('cart');
// Add to cart
Route::get('/add-to-cart/{vehicle}', [CartController::class, 'addToCart'])->name('add.to.cart');
// Delete items from cart
Route::get('/cart/delete/{id}', [CartController::class, 'deleteFromCart'])->name('cart.delete');
// Delete All items from cart
Route::get('/cart/delete-all', [CartController::class, 'deleteAllItems'])->name('delete.all.cart.items');


#######################Favourite Page Start###############################

// Add to favourite
Route::get('/add-to-fav/{vehicle}', [FavController::class, 'favVehicle'])->name('add.to.fav');
// Delete Items from Favourite
Route::get('/fav/delete/{id}', [FavController::class, 'deleteFromFav'])->name('fav.delete');
// Add All items to Cart
Route::get('/cart/move-to', [FavController::class, 'addAlltoCart'])->name('fav.mov.all.to.cart');
// Delete all items
Route::get('/fav/clear', [FavController::class, 'favDeleteAll'])->name('fav.clear.all');

#######################Favourite Page End###############################

// Proceed To Booking Form
Route::get('/bookingform/{vehicle}', [BookingController::class, 'BookingForm'])->name('proceedtocheckout');
Route::post('/bookingform/{vehicle}', [BookingController::class, 'submitBookingForm'])->name('booking.submit');

// Search For Vehicles
Route::get('/searchvehicles', [SearchVehicleController::class, 'SearchVehicles'])->name('searchvehicles');

// Admin Panel/Vehicle Upload
Route::prefix('admin/vehicles')->group(function () {
    Route::get('/vehicleupload', [VehicleController::class, 'vehicleFormShow'])->name('admin.vehicles.vehicleupload');
    Route::post('/', [VehicleController::class, 'store'])->name('admin.vehicles.store');
})->middleware(['auth', 'verified', 'role:admin']);

// Admin Panel Reservation verification
Route::prefix('admin/reservation')->group(function () {
    Route::get('/admin/notifications', [ReservationApproval::class, 'showNotifications'])->name('admin.reservation.notifications');

})->middleware(['auth', 'verified', 'role:admin']);

// Admin Panel/Edit Vehicle
Route::prefix('admin/edit/vehicles')->group(function () {
    Route::get('/vehicledit', [VehicleEdit::class, 'vehicleEditShow'])->name('admin.edit.vehicles.vehicledit');
    Route::delete('/vehicledit/{id}', [VehicleEdit::class, 'DestroyVehicle'])->name('admin.edit.vehicles.delete');
    Route::get('/vehicledit/{id}', [VehicleEdit::class, 'getVehicleUpdate'])->name('admin.edit.vehicles.getVehicleUpdate');
    Route::put('/vehicledit/{id}', [VehicleEdit::class, 'updateVehicle'])->name('admin.edit.vehicles.updateVehicle');
})->middleware(['auth', 'verified', 'role:admin']);


// ---------Categories----------
Route::prefix('admin')->group(function () {
    // Category Index
    Route::get('/categories', [categoryController::class, 'categoryIndex'])->name('admin.categoryIndex');

    // category form show
    Route::get('/addCategories-form', [categoryController::class, 'addCategoryForm'])->name('admin.category.show');

    // Category Create/Store
    Route::post('/categories-store', [categoryController::class, 'categoryStore'])->name('admin.category.store');

    // Category update form
    Route::get('/categories-edit/{id}', [categoryController::class, 'categoryEdit'])->name('admin.category.edit');

    // Category update
    Route::post('/categories-update/{id}', [categoryController::class, 'categoryUpdate'])->name('admin.category.update');

    // Delete Vehicel
    Route::get('/delete-category/{id}', [categoryController::class, 'categoryDelete'])->name('admin.category.delete');
})->middleware(['auth', 'verified', 'role:admin']);

// ----------Categories Ends----------


// Booking List
Route::prefix('admin')->group(function () {
    Route::get('/bookingList', [BookingList::class, 'bookingList'])->name('admin.booking.list');
    Route::get('reservations/{booking}', [ReservationApproval::class, 'reservationDetails'])->name('reservation.details');
})->middleware(['auth', 'verified', 'role:admin']);

// Accept/Reject
Route::prefix('admin')->group(function () {
    Route::get('/accept-reservation/{id}', [ReservationApproval::class, 'acceptReservation'])->name('reservation.accept');
    Route::get('/reject-reservation/{id}', [ReservationApproval::class, 'rejectReservation'])->name('reservation.reject');
    Route::get('/delete-reservation/{id}', [ReservationApproval::class, 'destroyReservation'])->name('reservation.delete');
    Route::get('/approve-payment/{id}', [ReservationApproval::class, 'approveCashPayment'])->name('approveCashPayment.approve');
})->middleware(['auth', 'verified', 'role:admin']);

// Verify Customers
Route::prefix('admin')->group(function () {
    Route::get('/verifycustomer', [VerifyCustomers::class, 'verifyCustomersIndex'])->name('verify.customer');
    Route::post('/admin/verifycustomer/{user}', [VerifyCustomers::class, 'verifyCustomers'])->name('admin.verify.customer');
    Route::post('/admin/unVerifycustomer/{user}', [VerifyCustomers::class, 'unVerifyCustomers'])->name('admin.unVerify.customer');
})->middleware(['auth', 'verified', 'role:admin']);

// Discunt Offers
Route::prefix('admin')->group(function () {
    Route::get('/discounts-coupons', [DiscountCoupons::class, 'discountForm'])->name('discounts.coupons');
    Route::post('/coupons-store', [DiscountCoupons::class, 'storeCoupons'])->name('coupons.store');
    Route::get('/index-coupons', [DiscountCoupons::class, 'retreieveCoupons'])->name('coupons.index');
    Route::get('/delete-coupons/{coupon}', [DiscountCoupons::class, 'deleteCoupons'])->name('coupons.delete');
    Route::post('/notify-user-about-coupons/{coupon}', [DiscountCoupons::class, 'notifyUserAbtCoupons'])->name('notify.coupons');
    Route::post('/withdraw-notification/{coupon}', [DiscountCoupons::class, 'withdrawCouponNotification'])->name('withdraw.notification');
})->middleware(['auth', 'verified', 'role:admin']);


// Stripe Payment Gateway
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('/proceedToPay/{booking}', 'proceedToPay')->name('proceedToPay');
    Route::post('/proceedToPay/{booking}', 'paymentWithDiscount')->name('proceedToPay.post');
    Route::get('/proceedToPay/payment/Success', 'successPayment')->name('successPayment');
    Route::get('/proceedToPay/payment/Canceled', 'canceledPayment')->name('canceledPayment');
});
