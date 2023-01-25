<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function editForm()
    {
        return view('profile', [
            'user' => Auth::user(),
        ]);
    }

    public function edit(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $userData = $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|file|mimes:png,jpg',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'new_password' => 'nullable|confirmed',
            'old_password' => 'required_with:new_password'
        ]);

        if ($userData['new_password']) {
            if(Hash::check($userData['old_password'], $user->password)) {
                $userData['password'] = Hash::make($userData['new_password']);
            } else {
                return back()
                    ->withErrors(['old_password' => 'Password is incorrect'])
                    ->withInput($request->all());
            }
        }

        if($request->file('avatar')) {
            if($user->avatar_path && Storage::fileExists($user->avatar_path)) {
                Storage::delete($user->avatar_path);
            }
            $userData['avatar_path'] = $request->file('avatar')->store('public');
        }

        $user->update($userData);

        return back()->withErrors(['success' => true]);
    }
}
