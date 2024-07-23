<?php

namespace App\Http\Controllers;
use App\Models\Permission; 
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $permissions = Permission::all(); 
        return view('dashboard.permission.index', compact('permissions', 'user'));
    }
}
