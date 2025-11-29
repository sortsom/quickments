<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\RequestLeave;
use App\Models\Member;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(){
        $attendance = Attendance::whereDate('date', today())->count();
        $requestleave = RequestLeave::whereDate('date', today())->count();
        $activeMembers = Member::where('status', '1')->count();
        $users = User::count();
        return view('dashboard',compact('attendance','requestleave','activeMembers','users'));
    }
}