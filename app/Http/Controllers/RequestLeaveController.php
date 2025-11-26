<?php

namespace App\Http\Controllers;

use App\Models\RequestLeave;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\LeaveType;
class RequestLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all(); // load members
        $leavetypes = LeaveType::all(); // load leave types
        return view('requestleave.index', compact('members', 'leavetypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $members=Member::all();
        $leavetypes = LeaveType::all();
        return view('requestleave.index',compact('members','leavetypes'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $data = $request->validate([
        'member_id' => 'required|exists:members,id',
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required',
        'type' => 'required',
        'reason' => 'nullable|string',
        'photo' => 'required|image',
        'status' => 'nullable|integer',
        'type_leave' => 'required|integer',
        'approve_by' => 'nullable|integer',
        'approve_date' => 'nullable|date',
    ]);

    // ✅ Force pending for normal users
    $data['status'] = auth()->user()->can('manage-leave')
        ? ($request->status ?? 0)
        : 0;

    // ✅ handle photo upload
    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('leave_photos', 'public');
    }

    LeaveRequest::create($data);

    return redirect()->back()->with('success', 'Leave request submitted!');
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
    }
}
