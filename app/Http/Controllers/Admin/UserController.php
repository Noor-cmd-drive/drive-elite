<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Sirf wo users layen jo admins nahi hain (taake sirf customers nazar aayen)
        $customers = User::where('role', '!=', 'admin')->latest()->get();
        return view('admin.users.index', compact('customers'));
    }

    public function destroy(User $user)
    {
        // Safety check: Admin apne aap ko delete na kar de
        if($user->role == 'admin') {
            return back()->with('error', 'System Administrators cannot be removed.');
        }
        
        $user->delete();
        return back()->with('success', 'Customer account has been permanently deactivated and removed.');
    }
}