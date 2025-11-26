<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\WorktimeController;
use App\Models\Attendance;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\RequestLeaveController;
use App\Http\Controllers\OvertimeWorkController;

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
    Route::resource('worktimes',WorktimeController::class);
    Route::resource('settings',SettingsController::class);
    Route::resource('requestleave',RequestLeaveController::class);
    Route::resource('overtime',OvertimeWorkController::class);


    // Vannak
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::delete('/attendance/{attendance}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');
    Route::post('/attendance', [AttendanceController::class, 'create'])->name('attendance.create');


});



require __DIR__.'/auth.php';