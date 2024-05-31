<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RoleStoreRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Support\Facades\Log;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('dashboard.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        // dd($permissions); // or var_dump($permissions);
        return view('dashboard.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */

    // dd($request->all());
    public function store(Request $request)
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


        Log::info('Role Created:', ['role' => $role, 'permissions' => $role->permissions]);

        alert()->success('Tambah Data Peran Berhasil', 'Data Peran Sudah Di Tambah !!!');
        return redirect()->route('dashboard.roles.index')->with('status', 'Data Peran User Berhasil Di Tambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        return view('dashboard.role.detail', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Role $role)
    {
        $permissions = Permission::all();
        // dd($role->permissions()->find(22));
        return view('dashboard.role.edit', compact('permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        // Log input permissions
        Log::info('Input Permissions:', ['permissions' => $validatedData['permissions']]);

        // Update role
        $role->update(['name' => strtolower($validatedData['name'])]);

        // Sinkronisasi permissions 
        $permissions = explode(',', $request->input('permissions', [])[0]);
        $role->permissions()->sync($permissions);

        Log::info('Role Updated:', ['role' => $role, 'permissions' => $role->permissions]);

        alert()->success('Edit Data Peran Berhasil', 'Data Peran Sudah Di Ubah !!!');
        return redirect()->route('dashboard.roles.index')->with('status', 'Data Peran User Berhasil Di Update!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();
        alert()->success('Proses Hapus Data Berhasil', 'Berhasil Hapus Data Peran User');
        return redirect()->route("dashboard.roles.index")->with('status', 'Data Peran User Berhasil Di Hapus!');
    }
}
