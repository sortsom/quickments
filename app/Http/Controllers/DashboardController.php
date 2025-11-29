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
        
        
        $dataQuery = Attendance::with(['member', 'details'])
            ->orderBy('date', 'desc');

        $user = Auth::user();

        // Check role
        if (!in_array($user->role->role, ['owner', 'admin'])) 
        {
            $memberId = Member::where('user_id', $user->id)->value('id');
            $dataQuery->where('member_id', $memberId);
        }
        $data = $dataQuery->paginate(2);
        // $data = $dataQuery->get();
        // echo($data);
        return view('dashboard',compact('attendance','requestleave','activeMembers','users','data'));
    }
}