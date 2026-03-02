<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index()
    {
        $users = User::with(['createdByUser', 'updatedByUser'])
                    ->latest()
                    ->paginate(10);
                    
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|unique:users,username|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['is_active'] = $request->has('is_active');
        $validated['created_by'] = Auth::id();

        $user = User::create($validated);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user
     */
    public function show(User $user)
    {
        $user->load(['createdByUser', 'updatedByUser']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'role' => 'required|in:admin,user',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['updated_by'] = Auth::id();

        // Don't allow admin to deactivate themselves
        if ($user->id === Auth::id() && !$validated['is_active']) {
            return back()->withErrors(['is_active' => 'You cannot deactivate your own account.']);
        }

        // Don't allow admin to downgrade their own role
        if ($user->id === Auth::id() && $validated['role'] !== 'admin') {
            return back()->withErrors(['role' => 'You cannot change your own role.']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
                        ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage
     */
    public function destroy(User $user)
    {
        // Don't allow admin to delete themselves
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'You cannot delete your own account.']);
        }

        // Don't allow deletion of the last admin
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return back()->withErrors(['error' => 'Cannot delete the last admin user.']);
        }

        $user->delete();

        return redirect()->route('admin.users.index')
                        ->with('success', 'User deleted successfully!');
    }

    /**
     * Show change password form for a specific user
     */
    public function showChangePasswordForm(User $user)
    {
        return view('admin.users.change-password', compact('user'));
    }

    /**
     * Change password for a specific user
     */
    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make($request->password),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('admin.users.index')
                        ->with('success', 'Password changed successfully for ' . $user->name . '!');
    }

    /**
     * Toggle user active status
     */
    public function toggleStatus(User $user)
    {
        // Don't allow admin to deactivate themselves
        if ($user->id === Auth::id()) {
            return back()->withErrors(['error' => 'You cannot change your own status.']);
        }

        $user->update([
            'is_active' => !$user->is_active,
            'updated_by' => Auth::id(),
        ]);

        $status = $user->is_active ? 'activated' : 'deactivated';
        
        return back()->with('success', "User {$status} successfully!");
    }
}