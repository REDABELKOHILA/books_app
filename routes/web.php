<?php

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Client\DownloadController;
use App\Http\Controllers\Client\FavoriteController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PdfController as AdminPdfController;
use App\Http\Controllers\Client\PdfController as ClientPdfController;
use App\Http\Controllers\Client\CategoryController as ClientCategoryController;


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/pdfs/{pdf}', function (Pdf $pdf) {
    return view('pdfs.show', compact('pdf'));
})->name('pdfs.show');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

// Generic dashboard (optional)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ✅ Client Dashboard
Route::middleware(['auth', 'role:client'])->group(function () {

    Route::get('/dashboard/user', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

    // ✅ تحميل PDF (فقط إذا شراه)
    Route::get('/pdfs/{pdf}/download', [ClientPdfController::class, 'download'])
        ->name('pdfs.download');

    // ✅ البحث عن PDF
    Route::get('/search', [ClientPdfController::class, 'search'])->name('search');

    // ✅ PDFs المشراة
    Route::get('/my-pdfs', [PurchaseController::class, 'myPdfs'])->name('user.pdfs');

    // ✅ شراء PDF
    Route::get('/pdfs/{pdf}/checkout', [PurchaseController::class, 'checkout'])->name('pdfs.checkout');
    Route::post('/pdfs/{pdf}/purchase', [PurchaseController::class, 'store'])->name('purchase.pdf');

    // ✅ التحميلات
    Route::get('/my-downloads', [DownloadController::class, 'index'])->name('client.downloads');
});

/*
|--------------------------------------------------------------------------
| Payment Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/checkout/{pdf}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/success/{pdf}', [PaymentController::class, 'success'])->name('payment.success');
});

/*
|--------------------------------------------------------------------------
| Profile Management
|--------------------------------------------------------------------------
*/

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('pdfs', AdminPdfController::class);
});

/*
|--------------------------------------------------------------------------
| Test Stripe Payment (for development)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/categories', [ClientCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [ClientCategoryController::class, 'show'])->name('categories.show');
});


Route::get('/test-payment', function () {
    try {
        Stripe::setApiKey(config('services.stripe.secret'));

        $charge = Charge::create([
            'amount' => 1000, // 10.00 USD
            'currency' => 'usd',
            'source' => 'tok_visa', // test token
            'description' => 'Test charge from Laravel',
        ]);

        dd($charge);
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
});

Route::post('/language-switch', function () {
    $locale = request('locale');
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return back();
})->name('language.switch');


// routes/web.php
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('favorites/{pdf}', [FavoriteController::class, 'store'])->name('favorites.store');
    Route::delete('favorites/{pdf}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
    Route::post('favorites/{pdf}/toggle', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
});




/*
|--------------------------------------------------------------------------
| Breeze Auth
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
