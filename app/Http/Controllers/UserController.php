<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('username', '!=', auth()->user()->username)->orderBy('id', 'desc')->get();
        $active = 'user';
        return view('user', compact('users', 'active'));
    }

    public function deleteDataUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('user')->with('success', 'User successfully deleted');
        } else {
            return redirect()->route('user')->with('error', 'Failed to delete user');
        }
    }

    public function updateDataUser(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'user_role' => $request->input('user_role'),
            ]);
            return redirect()->route('user')->with('success', 'User successfully updated');
        } else {
            return redirect()->route('user')->with('error', 'Failed to update user');
        }
    }

    public function tambahDataUser(Request $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'username' => $request->input('username'),
                'password' => bcrypt(1234), // Use bcrypt to hash passwords
                'user_role' => $request->input('user_role'),
            ]);
            return redirect()->route('user')->with('success', 'User successfully added');
        } catch (\Exception $e) {
            return redirect()->route('user')->with('error', 'Failed to add user. Error: ' . $e->getMessage());
        }
    }

    public function setDefaultPassword($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update(['password' => bcrypt(1234)]);
            // Log the password reset here
            return redirect()->route('user')->with('success', 'Password successfully reset to default');
        } else {
            return redirect()->route('user')->with('error', 'Failed to reset password');
        }
    }
}
