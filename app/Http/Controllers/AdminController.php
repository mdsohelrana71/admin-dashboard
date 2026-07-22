<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    public function dashboard() {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        return view('admin.dashboard', compact('totalUsers', 'totalAdmins'));
    }

    public function users() {
        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function createUser() {
        return view('admin.create-user');
    }

    public function storeUser(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role ?? 'user',
        ]);
        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    public function editUser($id) {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id) {
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        return redirect()->route('admin.users')->with('success', 'User updated successfully!');
    }

    public function deleteUser($id) {
        User::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function searchUsers(Request $request) {
        $search = $request->search;
        $users = User::where('role', 'user')
            ->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
            })->get();
        return response()->json($users);
    }

    public function admins() {
        $admins = User::where('role', 'admin')->get();
        return view('admin.admins', compact('admins'));
    }

    public function statistics() {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $totalAccounts = User::count();
        $latestUsers = User::latest()->take(5)->get();
        return view('admin.statistics', compact('totalUsers', 'totalAdmins', 'totalAccounts', 'latestUsers'));
    }

    public function charts() {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        
        // Users registered per month (last 6 months)
        $monthlyUsers = [];
        $monthLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthLabels[] = $month->format('M Y');
            $monthlyUsers[] = User::whereMonth('created_at', $month->month)
                                ->whereYear('created_at', $month->year)
                                ->count();
        }
        return view('admin.charts', compact('totalUsers', 'totalAdmins', 'monthlyUsers', 'monthLabels'));
    }

    public function dataTables() {
        $users = User::latest()->paginate(10);
        return view('admin.data-tables', compact('users'));
    }

    public function settings() {
        return view('admin.settings');
    }

    public function updateSettings(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        return back()->with('success', 'Settings updated successfully!');
    }

    public function notifications() {
        $latestUsers = User::latest()->take(10)->get();
        session(['notifications_read_at' => now()]);
        return view('admin.notifications', compact('latestUsers'));
    }
    
    public function security() {
        return view('admin.security');
    }

    public function updatePassword(Request $request) {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);
        if (!password_verify($request->current_password, auth()->user()->password)) {
            return back()->with('error', 'Current password is incorrect!');
        }
        auth()->user()->update([
            'password' => bcrypt($request->password),
        ]);
        return back()->with('success', 'Password updated successfully!');
    }

    public function profile() {
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        return view('admin.profile', compact('totalUsers', 'totalAdmins'));
    }

    public function updatePhoto(Request $request) {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $file = $request->file('profile_photo');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/profiles'), $filename);
        // Delete old photo
        if (auth()->user()->profile_photo) {
            $oldFile = public_path('uploads/profiles/' . auth()->user()->profile_photo);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }
        auth()->user()->update(['profile_photo' => $filename]);
        return back()->with('success', 'Profile photo updated successfully!');
    }
}