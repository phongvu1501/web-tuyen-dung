<?php

use App\Http\Controllers\Admin\ApplicationController as AdminApplicationController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JobController as AdminJobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/about', 'about')->name('about');
// Route::view('/news', 'news.index')->name('news.index');

Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');
Route::get('/application/success', [ApplicationController::class, 'success'])->name('applications.success');
Route::get('/careers/{job}', [CareerController::class, 'show'])->name('careers.show');
Route::get('/careers/{job}/apply', [ApplicationController::class, 'create'])->middleware('job.open')->name('careers.apply');
Route::post('/careers/{job}/apply', [ApplicationController::class, 'store'])->middleware('job.open')->name('careers.apply.store');

Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [LoginController::class, 'create'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'store'])->name('login.store');
});
Route::post('/admin/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('jobs', AdminJobController::class);
    Route::patch('jobs/{job}/publish', [AdminJobController::class, 'publish'])->name('jobs.publish');
    Route::patch('jobs/{job}/close', [AdminJobController::class, 'close'])->name('jobs.close');

    Route::get('applications', [AdminApplicationController::class, 'index'])->name('applications.index');
    Route::get('applications/{application}', [AdminApplicationController::class, 'show'])->name('applications.show');
    Route::patch('applications/{application}/status', [AdminApplicationController::class, 'updateStatus'])->name('applications.status');
    Route::get('applications/{application}/cv', [AdminApplicationController::class, 'viewCv'])->name('applications.cv.view');
    Route::get('applications/{application}/cv/download', [AdminApplicationController::class, 'downloadCv'])->name('applications.cv.download');
    Route::delete('applications/{application}', [AdminApplicationController::class, 'destroy'])->name('applications.destroy');

    Route::get('contacts', [ContactMessageController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactMessageController::class, 'show'])->name('contacts.show');
});
