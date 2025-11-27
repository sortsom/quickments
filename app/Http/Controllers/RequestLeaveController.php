<?php

namespace App\Http\Controllers;

use App\Models\RequestLeave;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\LeaveType;
use Illuminate\Validation\Rule;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RequestLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          

    // Define base query FIRST — do NOT call ->get() yet
        $query = RequestLeave::with(['member', 'typeLeave', 'status', 'approver', 'user']);

        $user = Auth::user();
        if (in_array(Auth::user()->role->role, ['owner', 'admin'])) {
        // Admin/Owner see all
        $requests = $query->latest()
                  ->get();
    } else {
        // Staff see only requests they created
        $requests = $query->where('user_id', $user->id)
                          ->latest()
                          ->get();
    }
        
    $members    = Member::all();
    $leavetypes = LeaveType::all();

    return view('requestleave.index', compact('members', 'leavetypes','requests'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members=Member::all();
        $leaves = LeaveType::all();
        return view('requestleave.index',compact('members','leaves'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $member = Member::findOrFail($request->member_id);
            
        $validated = $request->validate([
            'member_id'  => 'required|exists:members,id',
            'date'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
            'reason'     => 'nullable|string',
            'photo'      => 'nullable|image|max:2048',
            'type_leave' => [
                'required',
                Rule::exists('leave_types', 'id')->where(function ($q) use ($member) {
                    $q->whereIn('allowed', ['all','male',strtolower($member->gender)]);
                }),
            ],
            'type'=> 'required|string|in:full_day,half_day_morning,half_day_afternoon',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('leave_photos', 'public');
        }
        // dd($validated);
        // find the id of 'pending' from statuses
         $validated['user_id'] = auth()->id();
         $validated['status']= Status::where('name', 'Pending')->value('id'); // e.g. 1
         $validated['approve_by']   = null;
         $validated['approve_date'] = null;
        RequestLeave::create($validated);

        return redirect()->route('requestleave.index')
            ->with('success', 'Leave request created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(RequestLeave $requestLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestLeave $requestLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestLeave $requestLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestLeave $requestLeave)
    {
        //
       $requestLeave->delete(); // delete this record

    return redirect()->route('requestleave.index')
        ->with('success', 'Request deleted successfully');
    }
}
