<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});


//route middleware group auth and verified
//Route::middleware(['auth', 'verified'])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//
//});

Route::middleware(['auth', 'verified', 'admin'])->group(function () {


    Route::resource('groups', GroupController::class);
    Route::get('/groups/{group}/add/students', [GroupController::class, 'add'])->name('group.students_add');
    Route::post('/groups/{group}/add/students', [GroupController::class, 'add_students'])->name('group.students_add');
});

Route::middleware(['auth', 'verified', 'Teacher',])->group(function () {

    Route::resource('attendances', \App\Http\Controllers\AttendanceController::class);
    //show
    Route::get('attendances/{attendance:date}', [\App\Http\Controllers\AttendanceController::class, 'show'])->name('attendance.show');

    Route::resource('reports', \App\Http\Controllers\MonthlyReportController::class);

    Route::get('reports/{report:start_date}', [\App\Http\Controllers\MonthlyReportController::class, 'show'])->name('report.show');

    Route::get('reports/{MonthlyReport}/{WeeklyReport}', [\App\Http\Controllers\WeeklyReportController::class, 'show'])->name('weeklyReport.show');

    Route::resource('weekly_reports', \App\Http\Controllers\WeeklyReportController::class);

});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
//        dd(Auth::user()->group?->students()->with('attendances')->get()->pluck('attendances')->flatten());
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
