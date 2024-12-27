<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    // Menampilkan data profil pengguna yang login
    public function index()
    {
        $user = Auth::user(); // Mengambil user yang sedang login
        $profile = $user->profile; // Mengambil data profil user

        return view('user.dashboard.myprofile', compact('profile'))->with('title', 'Profile saya');
    }

    // Menampilkan form edit untuk data profil
    public function edit()
{
    $user = Auth::user();
    // Pastikan profil user ada
    $profile = $user->profile ?? new UserProfile(); // Jika profil tidak ditemukan, buatkan profil baru

    return view('user.dashboard.editProfile', compact('profile'))->with('title', 'Change Profile');
}


    // Memperbarui data profil
    public function update(Request $request)
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();
    
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telepon' => 'required|string|max:15',
            'gender' => 'required|string',
            'umur' => 'required|integer',
        ]);
    
        // Update data pengguna (nama dan email)
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
    
        // Cari atau buat profil pengguna
        $profile = UserProfile::firstOrNew(['user_id' => $user->id]);
    
        // Update data profil
        $profile->gender = $request->gender;
        $profile->umur = $request->umur;
        $profile->telepon = $request->telepon;
        $profile->save();
    
        // Redirect kembali dengan pesan sukses
        return redirect()->route('user_profiles.index')->with('success', 'Profil berhasil diperbarui.');
    }
    
}
