<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminDetailUpdatedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminManagementController extends Controller
{
    /**
     * Display admin management page.
     */
    public function index()
    {
        $currentAdmin = Auth::guard('admin')->user();

        // Only super_admin can manage admins
        if ($currentAdmin->role !== 'super_admin') {
            return redirect()->route('admin.home')->with('error', 'You do not have permission to manage administrators.');
        }

        $admins = Admin::orderBy('created_at', 'desc')->get();

        $totalAdmins = $admins->count();
        $activeAdmins = $admins->where('is_active', true)->count();
        $superAdmins = $admins->where('role', 'super_admin')->count();
        $regularAdmins = $admins->where('role', 'admin')->count();

        return view('admin.admins.index', compact(
            'admins',
            'totalAdmins',
            'activeAdmins',
            'superAdmins',
            'regularAdmins'
        ));
    }

    /**
     * Store a new admin.
     */
    public function store(Request $request)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if ($currentAdmin->role !== 'super_admin') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,super_admin',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => true,
        ]);

        // Send email notification to the new admin
        try {
            Mail::to($admin->email)->send(new AdminDetailUpdatedMail(
                $admin->name,
                'New Admin Account Created',
                ['Name' => $admin->name, 'Email' => $admin->email, 'Role' => ucfirst(str_replace('_', ' ', $admin->role))],
                $currentAdmin->name
            ));
        } catch (\Exception $e) {
            // Log but don't fail
        }

        return response()->json(['status' => 'success', 'message' => 'Administrator created successfully!']);
    }

    /**
     * Update an existing admin.
     */
    public function update(Request $request, $id)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if ($currentAdmin->role !== 'super_admin') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . $admin->id,
            'phone' => 'nullable|string|max:20',
            'role' => 'required|in:admin,super_admin',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        $changedFields = [];
        if ($admin->name !== $request->name) $changedFields['Name'] = $request->name;
        if ($admin->email !== $request->email) $changedFields['Email'] = $request->email;
        if ($admin->phone !== $request->phone) $changedFields['Phone'] = $request->phone ?? 'Removed';
        if ($admin->role !== $request->role) $changedFields['Role'] = ucfirst(str_replace('_', ' ', $request->role));

        $admin->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
        ]);

        // Send email notification
        if (!empty($changedFields)) {
            try {
                Mail::to($admin->email)->send(new AdminDetailUpdatedMail(
                    $admin->name,
                    'Admin Profile Updated',
                    $changedFields,
                    $currentAdmin->name
                ));
            } catch (\Exception $e) {
                // Log but don't fail
            }
        }

        return response()->json(['status' => 'success', 'message' => 'Administrator updated successfully!']);
    }

    /**
     * Reset an admin's password.
     */
    public function resetPassword(Request $request, $id)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if ($currentAdmin->role !== 'super_admin') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()], 422);
        }

        $admin->update(['password' => Hash::make($request->password)]);

        // Send email notification
        try {
            Mail::to($admin->email)->send(new AdminDetailUpdatedMail(
                $admin->name,
                'Password Reset',
                ['Action' => 'Your password was reset by an administrator'],
                $currentAdmin->name
            ));
        } catch (\Exception $e) {
            // Log but don't fail
        }

        return response()->json(['status' => 'success', 'message' => 'Password reset successfully!']);
    }

    /**
     * Toggle admin active status.
     */
    public function toggleStatus($id)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if ($currentAdmin->role !== 'super_admin') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $admin = Admin::findOrFail($id);

        // Prevent deactivating yourself
        if ($admin->id === $currentAdmin->id) {
            return response()->json(['status' => 'error', 'message' => 'You cannot deactivate your own account.'], 422);
        }

        $admin->is_active = !$admin->is_active;
        $admin->save();

        $status = $admin->is_active ? 'activated' : 'deactivated';

        // Send email notification
        try {
            Mail::to($admin->email)->send(new AdminDetailUpdatedMail(
                $admin->name,
                'Account ' . ucfirst($status),
                ['Status' => 'Your admin account has been ' . $status],
                $currentAdmin->name
            ));
        } catch (\Exception $e) {
            // Log but don't fail
        }

        return response()->json(['status' => 'success', 'message' => "Administrator {$status} successfully!"]);
    }

    /**
     * Delete an admin.
     */
    public function destroy($id)
    {
        $currentAdmin = Auth::guard('admin')->user();

        if ($currentAdmin->role !== 'super_admin') {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 403);
        }

        $admin = Admin::findOrFail($id);

        // Prevent deleting yourself
        if ($admin->id === $currentAdmin->id) {
            return response()->json(['status' => 'error', 'message' => 'You cannot delete your own account.'], 422);
        }

        $adminEmail = $admin->email;
        $adminName = $admin->name;

        $admin->delete();

        // Send email notification
        try {
            Mail::to($adminEmail)->send(new AdminDetailUpdatedMail(
                $adminName,
                'Account Removed',
                ['Action' => 'Your admin account has been removed from the system'],
                $currentAdmin->name
            ));
        } catch (\Exception $e) {
            // Log but don't fail
        }

        return response()->json(['status' => 'success', 'message' => 'Administrator deleted successfully!']);
    }
}
