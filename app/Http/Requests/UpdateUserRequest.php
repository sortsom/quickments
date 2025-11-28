<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user')->id;
        // dd($userId);

        return [
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $userId,
            'password'  => 'nullable|min:8',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'member_id' => 'nullable|exists:members,id',
            'role_name' => 'nullable|string'
        ];
    }

}
