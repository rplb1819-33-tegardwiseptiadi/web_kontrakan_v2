<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\ActivityLog;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $roles = Role::all();
        return view('auth.register', compact('roles'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'umur' => ['required', 'integer'],
            'jenis_kelamin' => ['required', 'in:Pria,Wanita'],
            'status_penghuni' => ['required', 'in:Sudah Menikah,Belum Menikah'],
            'gambar_ktp' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'gambar_profil' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'role_id' => ['required', 'exists:roles,id'],
        ]);
    }

    protected function create(array $data)
    {
        if (request()->hasFile('gambar_ktp')) {
            $gambarKtp = request()->file('gambar_ktp')->getClientOriginalName();
            request()->file('gambar_ktp')->move(public_path('/assets/upload/gambar_ktp/'), $gambarKtp);
            $data['gambar_ktp'] = $gambarKtp;
        } else {
            $data['gambar_ktp'] = null;
        }
     
        if (request()->hasFile('gambar_profil')) {
            $gambarProfile = request()->file('gambar_profil')->getClientOriginalName();
            request()->file('gambar_profil')->move(public_path('/assets/upload/gambar_profil/'), $gambarProfile);
            $data['gambar_profil'] = $gambarProfile;
        } else {
            $data['gambar_profil'] = null;
        }
    
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'umur' => $data['umur'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'status_penghuni' => $data['status_penghuni'],
            'gambar_ktp' => $data['gambar_ktp'],
            'gambar_profil' => $data['gambar_profil'],
            'role_id' => $data['role_id'],
            'email_verified_at' => now(), // Mengisi email_verified_at dengan waktu sekarang
            'remember_token' => Str::random(10), // Mengisi remember_token dengan token acak
        ]);
    
        // Log activity after successful registration
        ActivityLog::create([
            'user_id' => $user->id,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Registrasi Akun',
        ]);
    
        return $user;
    }
       
    protected function registered(Request $request, $user)
    {
        return redirect('/login')->with('success', 'Selamat, Anda berhasil register akun!');
    }
}
