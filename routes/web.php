<?php

declare(strict_types=1);

use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamLaboratoryexamController;
use App\Http\Controllers\LaboratoryexamController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
    Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
    Route::delete('/exams/{exam}', [ExamController::class, 'destroy'])->name('exams.destroy');
    Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::get('/exams/{exam}/file', [ExamController::class, 'destroyFile'])->name('exams.destroyFile');

    Route::get('/exams/{exam}/laboratoryexams', [ExamLaboratoryexamController::class, 'index'])->name('examLaboratoryexams.index');
    Route::get('/exams/{exam}/laboratoryexams/create', [ExamLaboratoryexamController::class, 'create'])->name('examLaboratoryexams.create');
    Route::post('/exams/{exam}/laboratoryexams', [ExamLaboratoryexamController::class, 'store'])->name('examLaboratoryexams.store');
    Route::delete('/exams/{exam}/laboratoryexams/{laboratoryexamId}', [ExamLaboratoryexamController::class, 'destroy'])->name('examLaboratoryexams.destroy');

    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/profile/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');

    Route::get('/laboratoryexams/{laboratoryexam}', [LaboratoryexamController::class, 'show'])->name('laboratoryexams.show');
});

require __DIR__ . '/auth.php';
