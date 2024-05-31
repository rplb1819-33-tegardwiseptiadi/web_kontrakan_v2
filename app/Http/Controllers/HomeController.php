<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
    
        if ($user->role_id == 1) {
            $complaints = Complaint::all();
        } else {
            $complaints = Complaint::where('user_id', $user->id)->get();
        }
    
        return view('dashboard.homepage.homepage', compact('complaints'));
    }
    
}
