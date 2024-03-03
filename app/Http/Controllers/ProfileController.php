<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{

    public function show()
    {
        $dataUserProfile = auth()->user(); // Fetch the authenticated user's profile data
        $active = 'user';
        return view('profile', compact('dataUserProfile','active'));
    }
    
        public function edit(Request $request)
        {
            $id = $request->input('id');
            $user = User::find($id);
            if ($user) {
                $user->update([
                    'name' => $request->input('name'),
                    'username' => $request->input('username'),
                    // 'user_role' => $request->input('user_role'),
                ]);
                // Log the update here
                return redirect()->route('profile')->with('success', 'Berhasil update profile');
            } else {
                return redirect()->route('profile')->with('error', 'Gagal update profile');
            }
        }
    
        public function changePassword(Request $request)
        {
            $id = $request->input('id');
            $passLama = $request->input('passLama');
            $passBaru = $request->input('passBaru');
            $passKonfir = $request->input('passKonfir');
    
            $user = User::find($id);
            if ($user) {
                if (password_verify($passLama, $user->password)) {
                    if ($passBaru == $passKonfir) {
                        $user->update(['password' => bcrypt($passBaru)]);
                        // Log the password update here
                        return redirect()->route('profile')->with('success', 'Password berhasil diubah');
                    } else {
                        return redirect()->route('profile')->with('error', 'Password baru dan konfirmasi password tidak cocok');
                    }
                } else {
                    return redirect()->route('profile')->with('error', 'Password lama tidak cocok');
                }
            } else {
                return redirect()->route('profile')->with('error', 'User tidak ditemukan');
            }
        }
}
