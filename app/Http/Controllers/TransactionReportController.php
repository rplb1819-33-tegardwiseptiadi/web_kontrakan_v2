<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Alert;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class TransactionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $transactions = Transaction::all();

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => null,
            'deskripsi' => 'Akses halaman daftar transaksi',
            'created_at' => now(),
        ]);

        return view('dashboard.laporan_transaksi.index', compact('transactions', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function show($id)
    {
        
        // Implementasi untuk menampilkan detail transaction report berdasarkan ID
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => $id,
            'deskripsi' => 'Melihat detail laporan transaksi',
            'created_at' => now(),
        ]);
    }

    public function cetakLaporanForm()
    {
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => null,
            'deskripsi' => 'Akses halaman formulir cetak laporan',
            'created_at' => now(),
        ]);
        
        return view('dashboard.laporan_transaksi.print-laporan-form');
    }
    
    public function cetakLaporanPertanggal(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'tgl_awal' => 'required|date',
            'tgl_akhir' => 'required|date',
        ], [
            'tgl_awal.required' => 'Tanggal Awal wajib diisi / tidak boleh kosong!',
            'tgl_akhir.required' => 'Tanggal Akhir wajib diisi / tidak boleh kosong!',
        ]);
        
        $tglawal = $request->input('tgl_awal');
        $tglakhir = $request->input('tgl_akhir');
        
        // Fetch transactions within the date range
        $cetakPertanggal = Transaction::whereBetween('tgl_transaksi', [$tglawal, $tglakhir])->get();
        
        // Check if data is found
        if ($cetakPertanggal->isEmpty()) {
            return response()->json(['error' => 'Data transaksi tidak ditemukan untuk rentang tanggal tersebut'], 404);
        }
        
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => null,
            'deskripsi' => 'Print Laporan Transaksi',
            'created_at' => now(),
        ]);
        $pdf = PDF::loadView('dashboard.laporan_transaksi.print-laporan-pertanggal', compact('cetakPertanggal', 'user'))->setPaper('a4', 'landscape');
        
        return $pdf->stream("laporan_transaksi_{$tglawal}_sampai_{$tglakhir}.pdf");
    }
}
