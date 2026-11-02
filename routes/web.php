
<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClassCompletionController;
use App\Http\Controllers\HomeworkTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::post('/classes/{eventId}/complete', [
        ClassCompletionController::class,
        'store'
    ])
        ->middleware(['auth', 'verified'])
        ->name('classes.complete');

Route::middleware(['auth', 'verified'])->group(function () {

            Route::get('/homework', [
                HomeworkTaskController::class,
                'index'
            ])->name('homework.index');
        
            Route::post('/homework', [
                HomeworkTaskController::class,
                'store'
            ])->name('homework.store');
            Route::patch('/homework/{homeworkTask}/toggle-complete', [
                HomeworkTaskController::class,
                'toggleComplete'
            ])->name('homework.toggleComplete');
            Route::put('/homework/{homeworkTask}', [
                HomeworkTaskController::class,
                'update'
            ])->name('homework.update');
            Route::delete('/homework/{homeworkTask}', [
                HomeworkTaskController::class,
                'destroy'
            ])->name('homework.destroy');
        
        });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])
    ->name('google.callback');
    
Route::get('/auth/google/link', [
        GoogleAuthController::class,
        'linkRedirect'
    ])->middleware('auth')->name('google.link');

Route::get('/auth/google/link/callback', [
    GoogleAuthController::class,
    'linkCallback'
])->middleware('auth')->name('google.link.callback');

require __DIR__.'/auth.php';
