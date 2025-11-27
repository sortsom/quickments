<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\User;
use App\Models\Roles;
use App\Http\Requests\StoreUserRequest;

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




}