<?php

namespace App\Http\Controllers;

use App\Charts\TransaksiBulananChart;
use App\Charts\KeluhanBulananChart; // Add the import statement for KeluhanBulananChart
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Rent;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(TransaksiBulananChart $transaksiChart, KeluhanBulananChart $keluhanChart) // Add KeluhanBulananChart as parameter
    {
        $user = auth()->user();

        $data['transaksiChart'] = $transaksiChart->build(); // Build the transaksi chart
        $data['keluhanChart'] = $keluhanChart->build(); // Build the keluhan chart

        // Fetch all necessary data
        $totalUsers = User::count();
        $totalRents = Rent::count();
        $totalInvestRent = Rent::sum('harga_kontrakan'); // Assuming there's an 'harga kontrakan' field
        $totalTransactions = Transaction::sum('total_harga'); // Assuming there's an 'total selurh bayar' field
        $totalComplaints = Complaint::count();

        $complaints = Complaint::all();

        return view('dashboard.homepage.homepage', $data, compact('complaints', 'totalUsers', 'totalRents', 'totalTransactions', 'totalInvestRent', 'totalComplaints'));
    }
}
