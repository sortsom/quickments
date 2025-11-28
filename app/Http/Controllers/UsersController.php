<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\User;
use App\Models\Roles;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;


use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $members = Member::doesntHave('user')->get();
        $users = User::with('member')->get();

        return view('users.index', compact('members', 'users'));

    }
    public function store(StoreUserRequest $request)
    {
        // dd($request);
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        $data['password'] = bcrypt($data['password']);

        // Create user
        $user = User::create($data);

        Roles::create([
            'role'  => $data['role_name'],
            'user_id' => $user->id,
        ]);

        Member::where('id', $data['member_id'])->update([
            'user_id' => $user->id
        ]);


        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request);
        $data = $request->validated();

        // ----------------------------
        // 1. Handle profile image
        // ----------------------------
        if ($request->hasFile('photo')) {

            // Delete old photo
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }

            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        // ----------------------------
        // 2. Update password only if typed
        // ----------------------------
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']); // prevent overriding with NULL
        }

        // ----------------------------
        // 3. Update user
        // ----------------------------
        $user->update($data);

        // ----------------------------
        // 4. Update role table
        // ----------------------------
        Roles::updateOrCreate(
            ['user_id' => $user->id],
            ['role' => $data['role_name']]
        );

        // ----------------------------
        // 5. Update member mapping
        // ----------------------------

        // (A) Remove old member link if exist
        Member::where('user_id', $user->id)->update(['user_id' => null]);

        // (B) Set new member
        if (!empty($data['member_id'])) {
            Member::where('id', $data['member_id'])->update([
                'user_id' => $user->id
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }


   
    public function destroy(User $user)
    {
        // dd($user);

        // delete user photo
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        // delete member (if exists)
        if ($user->member) {
            // delete member photo too
            if ($user->member->photo) {
                Storage::disk('public')->delete($user->member->photo);
            }

            $user->member->delete();
        }

        // delete role (if exists)
        if ($user->role) {
            $user->role->delete();
        }

        // finally delete user
        $user->delete();

        return back()->with('success', 'User deleted');
    }

   public function unlinkStaff(Member $member)
    {
        // Set user_id to NULL
        $member->user_id = null;
        $member->save();

        return back()->with('success', 'Staff unlinked successfully.');
    }




}