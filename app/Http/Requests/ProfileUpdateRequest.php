<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|file|mimes:png,jpg',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'new_password' => 'nullable|confirmed',
            'old_password' => 'required_with:new_password'
        ];
    }
}
