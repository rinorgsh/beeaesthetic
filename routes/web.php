<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\PurchaseController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/formation', [HomeController::class, 'formation'])->name('formation');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews');
Route::get('/a-propos', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/rendez-vous', [HomeController::class, 'rdv'])->name('rdv');
Route::get('/gallerie', [HomeController::class, 'gallerie'])->name('gallerie');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/test-error', function () {
    abort(404);
});

// Routes du shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.product');
Route::get('/download/{token}', [ShopController::class, 'download'])->name('shop.download');
Route::get('/download/item/{token}', [ShopController::class, 'downloadItem'])->name('shop.download.item');
Route::get('/panier', [ShopController::class, 'cart'])->name('shop.cart');

// Routes de paiement
Route::post('/checkout', [PaymentController::class, 'createCheckoutSession'])->name('checkout.session');
Route::post('/checkout/cart', [PaymentController::class, 'createCartCheckoutSession'])->name('checkout.cart');

Route::get('/payment/success/{order}', [PaymentController::class, 'success'])->name('payment.success');
Route::post('/webhook/stripe', [PaymentController::class, 'webhook'])->name('webhook.stripe');

// ❌ DASHBOARD ET PROFILE SUPPRIMÉS
// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// ✅ SEULES LES ROUTES ADMIN SONT PROTÉGÉES
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    
    // Gestion des commandes
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/ship', [App\Http\Controllers\Admin\OrderController::class, 'markAsShipped'])->name('orders.ship');
    
    // Gestion du site
    Route::get('/site', function () {
        return Inertia::render('Admin/Site/Index');
    })->name('site.index');
});

Route::get('/products/{product}/download', [DownloadController::class, 'download'])->name('products.download');

Route::get('/my-purchases', [PurchaseController::class, 'index'])->name('purchases.index');

Route::get('/download/token/{token}', [ShopController::class, 'downloadWithToken'])->name('shop.download.token');

require __DIR__.'/auth.php';