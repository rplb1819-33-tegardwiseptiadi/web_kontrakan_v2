<?php

namespace App\Http\Controllers;


use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Log;
use App\Models\ActivityLog;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $roles = Role::all();
        return view('dashboard.role.index', compact('roles', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $permissions = Permission::all();
        // dd($permissions); // or var_dump($permissions);
        return view('dashboard.role.create', compact('permissions', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // dd($request->all());
    public function store(RoleStoreRequest $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Log input permissions
        Log::info('Input Permissions:', ['permissions' => $validatedData['permissions']]);

        // Buat role baru
        $role = Role::create(['name' => strtolower($validatedData['name'])]);

        // Sinkronisasi permissions
        $permissions = explode(',', $request->input('permissions', [])[0]);
        $role->permissions()->sync($permissions);

          // Log activity
          ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'users',
            'id_referensi' => $role->id,
            'deskripsi' => 'Menambahkan Peran User Baru: ' . $role->name,
            'created_at' => now(),
        ]);
         
        Alert::success('Tambah Data Peran Berhasil', 'Data Peran Sudah Di Tambah !!!');
        return redirect()->route('dashboard.roles.index')->with('status', 'Data Peran User Berhasil Di Tambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $user = auth()->user();
        return view('dashboard.role.detail', compact('role', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Role $role)
    {
        $user = auth()->user();
        $permissions = Permission::all();
        // dd($role->permissions()->find(22));
        return view('dashboard.role.edit', compact('permissions', 'role', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $request, Role $role)
    {
        

        // Sinkronisasi permissions 
        $permissions = explode(',', $request->input('permissions', [])[0]);
        $role->permissions()->sync($permissions);

        Log::info('Role Updated:', ['role' => $role, 'permissions' => $role->permissions]);

        Alert::success('success', 'Edit Data Peran Berhasil', 'Data Peran Sudah Di Ubah !!!');
        return redirect()->route('dashboard.roles.index')->with('status', 'Data Peran User Berhasil Di Update!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    { 

        try {
            $roleId = $role->id; // Simpan ID sebelum dihapus
    
            // Pastikan tidak ada peran user yang masih terkait dengan penghuni
            $activeRoles = User::where('role_id', $roleId)->get();
    
            if ($activeRoles->isNotEmpty()) {
                Alert::error('Error', 'Peran User ini masih bersangkutan dengan data penghuni aktif.');
                return redirect()->route('dashboard.roles.index')->with('Error', 'Data Peran User Gagal Di Hapus!');;
            }
    
            $role->delete();
    
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'tabel_referensi' => 'roles',
                'id_referensi' => $roleId,
                'deskripsi' => 'Hapus Data Peran User',
                'created_at' => now(), // Assuming you want to log the deletion time
            ]);
    
             Alert::success('Hapus Data Peran User Berhasil', 'Data Peran User Berhasil Dihapus !!!');
            return redirect()->route("dashboard.roles.index")->with('status', 'Data Peran User Berhasil Di Hapus!');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
            return redirect()->route('dashboard.roles.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
} 
