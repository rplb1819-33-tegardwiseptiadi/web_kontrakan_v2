<?php

namespace App\Http\Controllers;

// Impor kelas Str dari namespace Illuminate\Support
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request; 
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\ActivityLog;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'umur' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'status_penghuni' => 'required|in:Sudah Menikah,Belum Menikah',
            'gambar_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'role_id' => 'required|exists:roles,id'
        ]);

        // Handle the file upload
        if ($request->hasFile('gambar_ktp')) {
            $gambarKtp = time() . '_' . $request->file('gambar_ktp')->getClientOriginalName();
            $request->file('gambar_ktp')->move(public_path('assets/upload/gambar_ktp'), $gambarKtp);
        }

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'umur' => $request->umur,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_penghuni' => $request->status_penghuni,
            'gambar_ktp' => $gambarKtp,
            'role_id' => $request->role_id,
            'email_verified_at' => null, // Tambahkan ini
            'remember_token' => Str::random(10) // Tambahkan ini
        ]);

        // Log activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Menambahkan User Baru: ' . $user->name,
            'created_at' => now(),
        ]);

        return redirect()->route('dashboard.users.index')->with('success', 'Tambah Data User Berhasil !!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        return view('dashboard.user.detail', compact('request', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.user.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        // Handle the file upload
        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $filename);
            $validated['gambar_ktp'] = $filename;
        }

        $user->update($validated);

        // Log activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Edit Data User: ' . $user->name,
            'created_at' => now(),
        ]);

        alert()->success('Edit Data User Berhasil', 'Data User Sudah Di Ubah !!!');
        return redirect()->route('dashboard.users.index')->with('status', 'Data User Berhasil Di Update!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        // Insert log activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Hapus Data User',
            'created_at' => now(),
        ]);

        alert()->success('Proses Hapus Data Berhasil', 'Berhasil Hapus Data User');
        return redirect()->route("dashboard.users.index")->with('status', 'Data User Berhasil Di Hapus!');
    }
}