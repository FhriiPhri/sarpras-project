<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            // Cek role setelah berhasil login
            if (Auth::user()->role !== 'admin') {
                Auth::logout();
                return redirect()->route('login')->withErrors([
                    'email' => 'Akses web ini hanya diperbolehkan untuk admin.',
                ]);
            }

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function dashboard()
    {
        $users = User::all();
        $totalUsers = User::where('role', 'user')->count();
        $totalKategori = Kategori::count();
        $totalBarang = Barang::count();
        $totalBarangRusak = Barang::where('kondisi', 'rusak')->count(); // pastikan kolom 'kondisi' benar
        return view('dashboard', compact('users', 'totalUsers', 'totalKategori', 'totalBarang', 'totalBarangRusak'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'You have been logged out.');
    }

    public function profile()
    {
        $user = Auth::user();
        return view('auth.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('auth.edit', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update name and email
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama jika ada
            if ($user->profile_picture) {
                Storage::delete('public/profile_pictures/' . $user->profile_picture);
            }

            // Simpan foto baru
            $file = $request->file('profile_picture');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/profile_pictures', $filename);

            $user->profile_picture = $filename;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
            $user->password_changed_at = now();
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['login', 'loginPost', 'register', 'registerPost']]);
        $this->middleware('guest')->only('login', 'register');
    }
}
