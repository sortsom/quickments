<?php

namespace App\Http\Controllers;

use App\Models\RequestLeave;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\LeaveType;
use Illuminate\Validation\Rule;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;


use Illuminate\Support\Facades\Auth;

class RequestLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
          
// Base query
    $query = RequestLeave::with(['member', 'typeLeave', 'status', 'approver', 'user']);

    $user = Auth::user();

    // ----------------------------
    // FETCH REQUEST LIST
    // ----------------------------
    if (in_array($user->role->role, ['owner', 'admin'])) {
        // Owner & Admin see all requests
        $requests = $query->latest()->get();
    } else {
        // Staff see only their own requests
        $requests = $query->where('user_id', $user->id)
                          ->latest()
                          ->get();
    }

    // ----------------------------
    // FETCH MEMBERS LIST
    // ----------------------------
    if (in_array($user->role->role, ['owner', 'admin'])) {
        // Show all members
        $members = Member::orderBy('name')->get();
    } else {
        // Staff: only their member record
        $members = Member::where('user_id', $user->id)
                         ->orderBy('name')
                         ->get();
    }

    // Leave types
    $leavetypes = LeaveType::all();

    // Send data to view
    return view('requestleave.index', compact('members', 'leavetypes', 'requests'));
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
public function edit($id)
{
    $members   = Member::orderBy('name')->get();
    $leavetypes = LeaveType::orderBy('name')->get();
    $requests = RequestLeave::findOrFail($id);
    return view('requestleave.edit', [
        'requests' => $requests,
        'members'      => $members,
        'leavetypes'   => $leavetypes,
    ]);
}


    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    $requestLeave = RequestLeave::findOrFail($id);

    // now continue with validated & update logic
    $validated = $request->validate([
        'member_id'  => 'required|exists:members,id',
        'date'       => 'required',
        'start_time' => 'required',
        'end_time'   => 'required',
        'reason'     => 'sometimes|nullable|string',
        'photo'      => 'sometimes|nullable|image|max:2048',
        'type_leave' => 'sometimes|nullable|exists:leave_types,id',
        'type'       => 'sometimes|nullable|in:full_day,half_day_morning,half_day_afternoon',
        // status if admin allowed...
    ]);

    // handle photo, status/approve logic, preserve user_id etc (reuse code from earlier)
    // example minimal:
    $attrs = $validated;
    if ($request->hasFile('photo')) {
        if ($requestLeave->photo && Storage::disk('public')->exists($requestLeave->photo)) {
            Storage::disk('public')->delete($requestLeave->photo);
        }
        $attrs['photo'] = $request->file('photo')->store('leave_photos', 'public');
    }

    // prevent overwriting id/timestamps
    unset($attrs['id'], $attrs['created_at'], $attrs['updated_at']);

    // preserve original user_id if not provided
    if (! array_key_exists('user_id', $attrs)) {
        $attrs['user_id'] = $requestLeave->user_id;
    }
    if (empty($attrs['user_id'])) {
        $attrs['user_id'] = auth()->id(); // fallback (or throw)
    }

    $requestLeave->fill($attrs);
    $requestLeave->save();

    return redirect()->route('requestleave.index')->with('success', 'Leave request updated successfully.');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       $requests = RequestLeave::findOrFail($id);
        $requests->delete();

    return redirect()->route('requestleave.index')
        ->with('success', 'Request deleted');
    }


    public function approve(Request $request, RequestLeave $requestleave)
{
    $user = Auth::user();

    if (!in_array(Auth::user()->role->role, ['owner', 'admin'])) {
        abort(403);
    }

     $approveStatusId = Status::where('name', 'Approve')->value('id');

    $requestleave->status_id = $approveStatusId;     // or ->status_id if you rename
     
    $requestleave->approve_by = Auth::user()->id;
    $requestleave->approve_date = now();
    $requestleave->save();

    return back()->with('success', 'Approved successfully');
}
public function Reject(Request $request, RequestLeave $requestleave)
{
    $user = Auth::user();

    if (!in_array(Auth::user()->role->role, ['owner', 'admin'])) {
        abort(403);
    }

     $approveStatusId = Status::where('name', 'Reject')->value('id');

    $requestleave->status_id = $approveStatusId;     // or ->status_id if you rename
     
    $requestleave->approve_by = Auth::user()->id;
    $requestleave->approve_date = now();
    $requestleave->save();

    return back()->with('success', 'Approved successfully');
}
public function report(Request $request)
{
    $user = Auth::user();

    // Member list
    if (in_array($user->role->role, ['owner', 'admin'])) {
        $members = Member::orderBy('name')->get();
    } else {
        $members = Member::where('user_id', $user->id)->orderBy('name')->get();
    }

    // Base query
    $query = RequestLeave::with(['user', 'member', 'typeLeave', 'status', 'approver']);

    // FILTER: member
    if ($request->filled('member')) {
        $query->where('member_id', $request->member);
    }

    // FILTER: from date
    if ($request->filled('from')) {
        $query->whereDate('created_at', '>=', $request->from);
    }

    // FILTER: to date
    if ($request->filled('to')) {
        $query->whereDate('created_at', '<=', $request->to);
    }

    // Get results
    $requests = $query->orderBy('created_at', 'desc')->get();

    return view('requestleave.report', compact('requests', 'members'));
}

}
