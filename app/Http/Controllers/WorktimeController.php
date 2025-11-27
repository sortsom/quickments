<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWorktimeRequest;
use App\Http\Requests\StorePerDayWorktimeRequest;
use App\Models\Member;
use App\Models\Worktime;
use App\Models\Weekly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorktimeController extends Controller
{
    public function index()
    {
        return view('worktime.index');
    }

    public function memberWorktime(Member $member)
    {
        $weekdays = Weekly::orderBy('sort')->get();

        $worktimes = $member->worktimes()
            ->with('weekly')
            ->get()
            ->keyBy('week_id'); 

        return view('worktime.index', compact('member', 'weekdays', 'worktimes'));
    }


    public function storeAllDay(StoreWorktimeRequest $request)
    {
        
        $validated = $request->validated();

        $memberId     = $validated['member_id'];
        $selectedDays = $validated['day'];
        $halfDay      = $validated['half_day'];

        Worktime::where('member_id', $memberId)
                ->whereNotIn('week_id', $selectedDays)
                ->delete();

        foreach ($selectedDays as $weekId) {

            $data = [
                'member_id'   => $memberId,
                'week_id'     => $weekId,
                'start_time'  => $validated['start_time'],
                'end_time'    => $validated['end_time'],
                'half_day'    => $halfDay,
            ];

            if ($halfDay == 1) {
                $data['start_time2'] = null;
                $data['end_time2']   = null;
            } else {
                $data['start_time2'] = $request->start_time2;
                $data['end_time2']   = $request->end_time2;
            }

            Worktime::updateOrCreate(
                ['member_id' => $memberId, 'week_id' => $weekId],
                $data
            );
        }

        return back()->with('success', 'Worktime updated successfully.');
    }



public function storePerDay(StorePerDayWorktimeRequest $request)
{
    $validated = $request->validated();

    $memberId = $validated['member_id'];
    $daysData = $validated['days'];   // array: 1..7

    // Delete records for days not included
    Worktime::where('member_id', $memberId)
            ->whereNotIn('week_id', array_keys($daysData))
            ->delete();

    foreach ($daysData as $weekId => $day) {

        // Normalize checkbox values
        $halfDay = !empty($day['half_day']) ? 1 : 0;
        $hasWork = !empty($day['work']) ? 1 : 0;

        // If no work and all fields empty → delete row 
        $isEmpty = (
            !$hasWork &&
            empty($day['start_time']) &&
            empty($day['end_time']) &&
            empty($day['start_time2']) &&
            empty($day['end_time2'])
        );

        if ($isEmpty) {
            Worktime::where('member_id', $memberId)
                    ->where('week_id', $weekId)
                    ->delete();
            continue;
        }

        // Prepare data for DB
        $data = [
            'member_id'  => $memberId,
            'week_id'    => $weekId,
            'start_time' => $day['start_time'] ?? null,
            'end_time'   => $day['end_time'] ?? null,
            'half_day'   => $halfDay,
        ];

        // Afternoon time
        if ($halfDay == 1) {
            // Morning only → clear afternoon
            $data['start_time2'] = null;
            $data['end_time2']   = null;
        } else {
            // Full day → accept update for afternoon
            $data['start_time2'] = $day['start_time2'] ?? null;
            $data['end_time2']   = $day['end_time2'] ?? null;
        }

        Worktime::updateOrCreate(
            ['member_id' => $memberId, 'week_id' => $weekId],
            $data
        );
    }

    return back()->with('success', 'Worktime updated successfully.');
}














    
}