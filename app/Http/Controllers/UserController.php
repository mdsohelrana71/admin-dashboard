<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    // ********* Dashboard ********* // 
    public function dashboard() {
        return view('user.dashboard');
    }
    // ********* Update profile ********* //
    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.auth()->id(),
        ]);
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return response()->json(['success' => true, 'message' => 'Profile updated successfully!']);
    }
    // ********* Update password ********* //
    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if(!Hash::check($request->current_password, auth()->user()->password)) {
            return response()->json(['success' => false, 'message' => 'Current password is incorrect!']);
        }
        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);
        return response()->json(['success' => true, 'message' => 'Password updated successfully!']);
    }
}