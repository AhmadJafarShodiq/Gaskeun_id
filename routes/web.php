<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\OrderController; // Added this line

use App\Models\Service;
use App\Models\Order;
use App\Models\Portfolio; // Added this line
use App\Models\Testimonial; // Added this line

Route::get('/', function () {
    $services = Service::all();
    $orderCount = Order::where('status', 'selesai')->count();
    $portfolios = Portfolio::latest()->get(); // Added this line
    $testimonials = Testimonial::latest()->get(); // Added this line
    return view('welcome', compact('services', 'orderCount', 'portfolios', 'testimonials')); // Modified this line
})->name('home'); // Added this line

Route::post('/inquiry', [InquiryController::class, 'store'])->name('inquiry.store');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest'); // Modified this line

Route::post('/login', function (\Illuminate\Http\Request $request) { // Modified this line
    $credentials = $request->validate([ // Modified this line
        'email' => 'required|email', // Modified this line
        'password' => 'required' // Modified this line
    ]); // Modified this line

    if (\Illuminate\Support\Facades\Auth::attempt($credentials)) { // Modified this line
        $request->session()->regenerate(); // Modified this line
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors(['email' => 'Email atau password salah!']);
})->name('login.post');

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\TestimonialController; // Added this line

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Services
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
    
    // Portfolios
    Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
    Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
    Route::put('/portfolios/{id}', [PortfolioController::class, 'update'])->name('portfolios.update');
    Route::delete('/portfolios/{id}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');

    // Testimonials // Added this section
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
    Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
    Route::put('/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');

    // Orders & Inquiries list pages
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('inquiries.index');
    Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])->name('inquiry.destroy');

    
    // Status update for order
    Route::post('/order/{id}/update', [AdminController::class, 'updateOrder'])->name('order.update');
});

Route::post('/admin/inquiry/{id}/update', [InquiryController::class, 'update'])->name('inquiry.update');

Route::post('/logout', function (\Illuminate\Http\Request $request) {
    \Illuminate\Support\Facades\Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');
