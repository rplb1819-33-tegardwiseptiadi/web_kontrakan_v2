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

    public function index(TransaksiBulananChart $transaksiChart, KeluhanBulananChart $keluhanChart)
    {
        // Ambil data pengguna yang sedang login
        $user = Auth::user();

        $data['transaksiChart'] = $transaksiChart->build(); // Build the transaksi chart
        $data['keluhanChart'] = $keluhanChart->build(); // Build the keluhan chart

        // Fetch role data for the logged-in user
        $roleName = $user->role?->name; // Ambil nama role dari pengguna yang sedang login

        if ($roleName == 'administrator') { // Periksa jika role adalah 'administrator'
            $totalUsers = User::count();
            $totalRents = Rent::count();
            $totalInvestRent = Rent::sum('harga_kontrakan'); // Asumsikan ada kolom 'harga_kontrakan'
            $totalTransactions = Transaction::sum('total_harga'); // Asumsikan ada kolom 'total_harga'
            $totalComplaints = Complaint::count();

            $complaints = Complaint::where('status_keluhan', 'Sudah Divalidasi')->get();

            $data = array_merge($data, [
                'totalUsers' => $totalUsers,
                'totalRents' => $totalRents,
                'totalInvestRent' => $totalInvestRent,
                'totalTransactions' => $totalTransactions,
                'totalComplaints' => $totalComplaints,
                'complaints' => $complaints,
                'roleName' => $roleName, // Pastikan roleName dikirim ke view
            ]);
        } else {
            // Untuk non-administrator, ambil data spesifik untuk pengguna
            $totalRents = Rent::count();

            $totalTransactions = Transaction::where('user_id', $user->id)->sum('total_harga');

            // Hitung total complaints untuk pengguna yang sedang login
            $totalComplaintsUser = Complaint::where('user_id', $user->id)->count();

            $complaints = Complaint::where('status_keluhan', 'Sudah Divalidasi')->get();


            // Tampilkan data untuk debug
            // dd($user->id, $totalRents, $totalTransactions, $totalComplaintsUser, $complaints);


            $data = array_merge($data, [
                'totalRents' => $totalRents,
                'totalTransactions' => $totalTransactions,
                'totalComplaintsUser' => $totalComplaintsUser,
                'complaints' => $complaints,
                'roleName' => $roleName, // Pastikan roleName dikirim ke view
            ]);
        }

        return view('dashboard.homepage.homepage', $data);
    }
}
