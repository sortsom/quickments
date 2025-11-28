<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\WorktimeController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RequestLeaveController;
use App\Http\Controllers\OvertimeWorkController;
use App\Http\Controllers\UsersController;


Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('members', MemberController::class);
    Route::resource('leave-types',LeaveTypeController::class);

    Route::resource('settings',SettingsController::class);

    Route::resource('requestleave',RequestLeaveController::class);
    Route::post('requestleave/{requestleave}/approve', [RequestLeaveController::class, 'approve'])
    ->name('requestleave.approve');
    
    Route::resource('overtime',OvertimeWorkController::class);

    


    // Vannak
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::put('/attendance/{attendance}', [AttendanceController::class, 'update'])->name('attendance.update');
    
    Route::get('/worktimes', [WorktimeController::class, 'index'])
    ->name('worktimes.index');

    Route::get('/worktimes/{member}', [WorktimeController::class, 'memberWorktime'])->name('worktimes.member');
    Route::post('worktimes/storeall', [WorktimeController::class, 'storeAllDay'])->name('worktimes.storeall');
    Route::post('worktimes/store-per-day', [WorktimeController::class, 'storePerDay'])->name('worktimes.storeday');

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{member}/unlink', [UsersController::class, 'unlinkStaff'])->name('users.unlinkstaff');
    Route::patch('/users/{user}', [UsersController::class, 'update'])->name('users.update');




    
});



require __DIR__.'/auth.php';