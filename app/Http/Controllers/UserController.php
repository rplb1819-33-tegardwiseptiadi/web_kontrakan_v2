<?php

namespace App\Http\Controllers;

// Impor kelas Str dari namespace Illuminate\Support
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request; 
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\ActivityLog;
use App\Models\Transaction;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $users = User::all();
        return view('dashboard.user.index', compact('users', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $roles = Role::all();
        return view('dashboard.user.create', compact('roles', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(UserStoreRequest $request)
    {
         
        // Handle the file upload
        if ($request->hasFile('gambar_ktp')) {
            $gambarKtp = time() . '_' . $request->file('gambar_ktp')->getClientOriginalName();
            $request->file('gambar_ktp')->move(public_path('assets/upload/gambar_ktp'), $gambarKtp);
        }
        if ($request->hasFile('gambar_profil')) {
            $gambarProfil = time() . '_' . $request->file('gambar_profil')->getClientOriginalName();
            $request->file('gambar_profil')->move(public_path('assets/upload/gambar_profil'), $gambarProfil);
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
            'gambar_profil' => $gambarProfil,
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

        Alert::success('Tambah Data User Berhasil', 'Data User Sudah Di Tambah !!!');
        return redirect()->route('dashboard.users.index')->with('status', 'Tambah Data User Berhasil !!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        $users = auth()->user();
        return view('dashboard.user.detail', compact('request', 'user', 'users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $users = auth()->user();
        $roles = Role::all();
        return view('dashboard.user.edit', compact('roles', 'users', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $validated = $request->validated();
    
        // Mengatur password jika ada
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
    
        // Menangani upload file
        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/upload/gambar_ktp'), $filename);
            $validated['gambar_ktp'] = $filename;
        }
    
        if ($request->hasFile('gambar_profil')) {
            $file = $request->file('gambar_profil');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/upload/gambar_profil'), $filename);
            $validated['gambar_profil'] = $filename;
        }
    
        // Cek role_id dan menentukan kolom mana yang perlu diupdate
        if ($user->role_id == 1) {
            // Jika role_id adalah 1, hanya perbarui kolom tertentu
            $updateFields = ['name', 'email', 'password', 'umur', 'jenis_kelamin', 'status_penghuni', 'gambar_ktp', 'gambar_profil'];
            $updateData = array_intersect_key($validated, array_flip($updateFields));
            $user->update($updateData);
        } else {
            // Jika role_id bukan 1, perbarui semua kolom
            $user->update($validated);
        }
    
        // Log aktivitas
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'users',
            'id_referensi' => $user->id,
            'deskripsi' => 'Edit Data User: ' . $user->name,
            'created_at' => now(),
        ]);
    
        Alert::success('Edit Data User Berhasil', 'Data User Berhasil Di Update !!!');
        return redirect()->route('dashboard.users.index')->with('status', 'Data User Berhasil Di Update!');
    }
    

    public function destroy(User $user)
    {
        try {
            $userId = $user->id; // Simpan ID sebelum dihapus
    
            // Pastikan tidak ada transaksi yang masih aktif terkait rent ini
            $activeUsers = Transaction::where('user_id', $userId)->get();
    
            if ($activeUsers->isNotEmpty()) {
                Alert::error('Error', 'User ini masih memiliki data transaksi & data keluhan aktif.');
                return redirect()->route('dashboard.users.index')->with('Error', 'Data User Gagal Di Hapus!');;
            }
    
            $user->delete();
    
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'tabel_referensi' => 'users',
                'id_referensi' => $userId,
                'deskripsi' => 'Hapus Data User',
                'created_at' => now(), // Assuming you want to log the deletion time
            ]);
    
            Alert::success('Hapus Data User Berhasil', 'Data User Sudah Dihapus !!!');
            return redirect()->route('dashboard.users.index')->with('status', 'Data User Berhasil Di Hapus!');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
            return redirect()->route('dashboard.users.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
    

}