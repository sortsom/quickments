<?php

namespace App\Http\Controllers;

use App\Models\Worktime;
use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Weekly;

class WorktimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
       
        return view('worktime.index');
    }

    public function memberWorktime(Member $member)
    {
        $weekdays = Weekly::orderBy('sort')->get();

        // Worktime keyed by week_id for fast access
        $worktimes = $member->worktimes()->with('weekly')->get()->keyBy('week_id');

        return view('worktime.index', compact('member', 'weekdays', 'worktimes'));
    }






    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Worktime $worktime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Worktime $worktime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Worktime $worktime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Worktime $worktime)
    {
        //
    }
}