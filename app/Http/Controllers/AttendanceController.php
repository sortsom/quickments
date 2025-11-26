<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;  
use App\Models\AttendanceDetail;
use App\Models\Worktime;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataQuery = Attendance::with(['member', 'details'])
            ->orderBy('date', 'desc');

        $user = Auth::user();
        if (!in_array($user->role->role, ['owner', 'admin'])) {
            $memberId = Member::where('user_id', $user->id)->value('id'); 
            $dataQuery->where('member_id', $memberId);
            $members = Member::where('id', $memberId)->get();  
        } else {
            $members = Member::all();
        }
        $data = $dataQuery->get();

        return view('attendances.index', compact('data', 'members'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
    }
    public function store(Request $request)
    {
        
        $memberId  = $request->member;
        $startDate = Carbon::parse($request->start_date);
        $endDate   = Carbon::parse($request->end_date);

        $current = $startDate;

        $results = [];
        $insertedCount = 0;
        $skippedCount  = 0;

        while ($current->lte($endDate)) {

            $date = $current->format('Y-m-d');

            // Check duplicate date
            if (Attendance::where('member_id', $memberId)->where('date', $date)->exists()) {

                $results[] = [
                    'date' => $date,
                    'status' => 'Skipped',
                    'reason' => 'Duplicate attendance found'
                ];

                $skippedCount++;
                $current->addDay();
                continue;
            }

            // Worktime
            $dayOfWeek = $current->dayOfWeek + 1;

            $worktime = Worktime::where('member_id', $memberId)
                                ->where('day', $dayOfWeek)
                                ->first();

            if (!$worktime) {

                $results[] = [
                    'date' => $date,
                    'status' => 'Skipped',
                    'reason' => 'No worktime found for this weekday'
                ];

                $skippedCount++;
                $current->addDay();
                continue;
            }

            // Insert attendance
            $attendance = Attendance::create([
                'member_id'   => $memberId,
                'start_time'  => $worktime->start_time,
                'end_time'    => $worktime->end_time,
                'start_time2' => $worktime->half_day ? null : $worktime->start_time2,
                'end_time2'   => $worktime->half_day ? null : $worktime->end_time2,
                'date'        => $date,
                'status'      => 1,
                'half_time'   => $worktime->half_day
            ]);

            $results[] = [
                'date' => $date,
                'status' => 'Inserted',
                'reason' => 'Attendance created successfully',
                'attendance_id' => $attendance->id
            ];

            $insertedCount++;

            // Details...
            $details = ($worktime->half_day == 1)
                ? [1 => $request->time1, 2 => $request->time2]
                : [1 => $request->time1, 2 => $request->time2, 3 => $request->time3, 4 => $request->time4];

            foreach ($details as $type => $clock) {
                if (!$clock) continue;
               
                $clockTime = Carbon::parse($clock);

                // Determine correct worktime field
                switch ($type) {
                    case 1:
                        $work = Carbon::parse($worktime->start_time);
                        $isLate = $clockTime->gt($work);
                        $status = $isLate ? "Late" : "Good";
                        $count  = $isLate ? $clockTime->diffInMinutes($work) : 0;
                        break;

                    case 2:
                        $work = Carbon::parse($worktime->end_time);
                        $isEarly = $clockTime->lt($work);
                        $status  = $isEarly ? "Early" : "Good";
                        $count   = $isEarly ? $work->diffInMinutes($clockTime) : 0;
                        break;

                    case 3:
                        $work = Carbon::parse($worktime->start_time2);
                        $isLate = $clockTime->gt($work);
                        $status = $isLate ? "Late" : "Good";
                        $count  = $isLate ? $clockTime->diffInMinutes($work) : 0;
                        break;

                    case 4:
                        $work = Carbon::parse($worktime->end_time2);
                        $isEarly = $clockTime->lt($work);
                        $status  = $isEarly ? "Early" : "Good";
                        $count   = $isEarly ? $work->diffInMinutes($clockTime) : 0;
                        break;
                }

                AttendanceDetail::create([
                    'attendance_id' => $attendance->id,
                    'clock'         => $clockTime->format('H:i:s'),
                    'check_type'    => $type,
                    'status'        => $status,
                    'reason'        => $request->reason,
                    'count_time'    => abs($count)
                ]);
            
            }

            $current->addDay();
        }

        // Add summary to results
        $summary = [
            'inserted' => $insertedCount,
            'skipped'  => $skippedCount,
            'total_days' => $insertedCount + $skippedCount,
        ];

        return redirect()->route('attendance.index')
                        ->with('success', 'Attendance insert process complete.')
                        ->with('log', $results)
                        ->with('summary', $summary);

    }


    




    /**
     * Display the specified resource.
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attendance $attendance)
    {
        $memberId = $request->member;
        $date     = Carbon::parse($request->date)->format('Y-m-d');

        // Prevent duplicate (only if another attendance exists on same date)
        $duplicate = Attendance::where('member_id', $memberId)
                    ->where('date', $date)
                    ->where('id', '!=', $attendance->id)
                    ->exists();

        if ($duplicate) {
            return back()->with('error', 'Attendance already exists on this date.');
        }

        // Get worktime for this day of week
        $dayOfWeek = Carbon::parse($date)->dayOfWeek + 1; // your system uses 1–7
        $worktime  = Worktime::where('member_id', $memberId)
                            ->where('day', $dayOfWeek)
                            ->first();

        if (!$worktime) {
            return back()->with('error', 'No worktime defined for this day.');
        }

        // ================================
        // UPDATE MAIN ATTENDANCE RECORD
        // ================================
        $attendance->update([
            'member_id'   => $memberId,
            'start_time'  => $worktime->start_time,
            'end_time'    => $worktime->end_time,
            'start_time2' => $worktime->half_day ? null : $worktime->start_time2,
            'end_time2'   => $worktime->half_day ? null : $worktime->end_time2,
            'date'        => $date,
            'half_time'   => $worktime->half_day,
            'status'      => 1,
        ]);

        // Delete old details
        AttendanceDetail::where('attendance_id', $attendance->id)->delete();

        // ================================
        // PREPARE DETAILS BASED ON HALF DAY
        // ================================
        $details = ($worktime->half_day == 1)
            ? [1 => $request->time1, 2 => $request->time2]
            : [1 => $request->time1, 2 => $request->time2, 3 => $request->time3, 4 => $request->time4];

        // ================================
        // INSERT NEW DETAILS
        // ================================
        foreach ($details as $type => $clock) {

            if (!$clock) continue; // skip empty

            $clockTime = Carbon::parse($clock);

            switch ($type) {
                case 1:
                    $work   = Carbon::parse($worktime->start_time);
                    $status = $clockTime->gt($work) ? "Late" : "Good";
                    $count  = $status === "Late" ? $clockTime->diffInMinutes($work) : 0;
                    break;

                case 2:
                    $work   = Carbon::parse($worktime->end_time);
                    $status = $clockTime->lt($work) ? "Early" : "Good";
                    $count  = $status === "Early" ? $work->diffInMinutes($clockTime) : 0;
                    break;

                case 3:
                    $work   = Carbon::parse($worktime->start_time2);
                    $status = $clockTime->gt($work) ? "Late" : "Good";
                    $count  = $status === "Late" ? $clockTime->diffInMinutes($work) : 0;
                    break;

                case 4:
                    $work   = Carbon::parse($worktime->end_time2);
                    $status = $clockTime->lt($work) ? "Early" : "Good";
                    $count  = $status === "Early" ? $work->diffInMinutes($clockTime) : 0;
                    break;
            }

            AttendanceDetail::create([
                'attendance_id' => $attendance->id,
                'clock'         => $clockTime->format('H:i:s'),
                'check_type'    => $type,
                'status'        => $status,
                'reason'        => $request->reason,
                'count_time'    => abs($count),
            ]);
        }

        return redirect()->route('attendance.index')
            ->with('success', 'Attendance updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        return redirect()->route('attendance.index')->with('success', 'Attendance deleted successfully.');
    }

    
}