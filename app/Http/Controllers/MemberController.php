<?php

namespace App\Http\Controllers;
use Illuminate\Validation\Rule;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('members.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => ['required','email', Rule::unique('members', 'email')],
        'name_kh'  => 'nullable|string|max:255',
        'gender'   => 'nullable|in:male,female,other',
        'dob'      => 'nullable|date',
        'photo' => 'nullable|image|max:2048',
        'position' => 'nullable|string|max:255',
        'phone'    => 'nullable|string|max:50',
        'address'  => 'nullable|string|max:500',
        'status'   => 'nullable|boolean',
    ]);
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')
                                      ->store('photos', 'public');
                                    }

        Member::create($validated);

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
        return view('members.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
        $validated = $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => ['required','email', Rule::unique('members', 'email')->ignore($member->id)],
        'name_kh'  => 'nullable|string|max:255',
        'gender'   => 'nullable|in:male,female,other',
        'dob'      => 'nullable|date',
        'photo' => 'nullable|image|max:2048',
        'position' => 'nullable|string|max:255',
        'phone'    => 'nullable|string|max:50',
        'address'  => 'nullable|string|max:500',
        'status'   => 'nullable|boolean',
    ]);
    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')
                                      ->store('photos', 'public');
                                    
    }
        $member->update($validated);

        return redirect()->route('members.index')->with('success', 'Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
        $member->delete();
        return redirect()->route('members.index')->with('success', 'Member deleted successfully.');
    }
}
