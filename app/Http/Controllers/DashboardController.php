<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\RequestLeave;
use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $attendance = Attendance::whereDate('date', today())->count();
        $requestleave = RequestLeave::whereDate('date', today())->count();
        $activeMembers = Member::where('status', '1')->count();
        $users = User::count();
        $dataQuery = Attendance::with(['member', 'details'])->orderBy('date', 'desc');

        $user = Auth::user();
        $role = $user->role->role;

        // Owner/Admin → Today only
        if (in_array($role, ['owner', 'admin'])) {
            $dataQuery->whereDate('date', now()->toDateString());

        } else {
            // Normal staff → last 7 days only
            $memberId = Member::where('user_id', $user->id)->value('id');

            $dataQuery->where('member_id', $memberId)
                    ->whereBetween('date', [
                            now()->subDays(7)->toDateString(),
                            now()->toDateString()
                    ]);
        }

        $data = $dataQuery->paginate(5);

        return view('dashboard', compact('attendance','requestleave','activeMembers','users','data'));
    }
}