<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

Route::get('/init-db', function () {
    // Force some configs to ensure we can run migrations
    config(['session.driver' => 'file']);
    config(['app.debug' => true]);

    $step = request('step', 'all');

    try {
        echo "Checking connection...<br>";
        \DB::connection()->getPdo();
        echo "Connection successful!<br><br>";

        if ($step === 'migrate' || $step === 'all') {
            echo "Running migrations...<br>";
            \Illuminate\Support\Facades\Artisan::call('migrate', [
                '--force' => true,
            ]);
            echo "Migrations output:<br><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre><br>";
        }

        if ($step === 'seed' || $step === 'all') {
            echo "Running seeders...<br>";
            \Illuminate\Support\Facades\Artisan::call('db:seed', [
                '--force' => true,
            ]);
            echo "Seeders output:<br><pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre><br>";
        }

        return "Database Step ($step) Successful! <br><br> <a href='/init-db?step=seed'>Click here to Seed (if you only migrated)</a> | <a href='/'>Go to Home</a>";
    } catch (\Exception $e) {
        return "Error occurred in step ($step):<br><pre>" . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "</pre>";
    }
});

Route::get('/', function () {
    $services = \App\Models\Service::all();
    $news = \App\Models\News::all();
    $testimonials = \App\Models\Testimonial::all();
    $faqs = \App\Models\Faq::all();
    return view('home', compact('services', 'news', 'testimonials', 'faqs'));
});

Route::post('/consultation', [ConsultationController::class, 'store'])->name('consultation.store');

// Admin Auth Routes
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Admin Protected Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Placeholder routes for CRUDs (will implement controllers later)
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class)->names('services');
    Route::resource('news', App\Http\Controllers\Admin\NewsController::class)->names('news');
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class)->names('testimonials');
    Route::resource('faqs', App\Http\Controllers\Admin\FaqController::class)->names('faqs');
    Route::resource('consultations', App\Http\Controllers\Admin\ConsultationController::class)->names('consultations');

    // Website Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});

