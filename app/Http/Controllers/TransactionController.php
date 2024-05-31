<?php

namespace App\Http\Controllers;

// Impor kelas Str dari namespace Illuminate\Support
use Illuminate\Support\Str;

use RealRashid\SweetAlert\Facades\Alert;
// use App\Models\user;
use App\Models\User;
use App\Models\Rent;
use App\Models\Transaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Requests\TransactionStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use Barryvdh\DomPDF\Facade\PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    // fungsi print data
    public function print(Request $request, Transaction $transaction)
    {
        // Mengakses nama penghuni melalui relasi dengan model User
        $namaUser = $transaction->user->name;

        $pdf = PDF::loadView('dashboard.transaksi.print', compact('transaction', 'request', 'namaUser'))->setPaper('a4', 'landscape');

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => $transaction->id,
            'deskripsi' => 'Print Data Transaksi',
            'created_at' => now(),
        ]);

        // Simpan file PDF dengan nama yang sesuai
        $pdfFileName = 'transaction_' . Str::slug($namaUser) . '.pdf';
        $pdfFilePath = storage_path('app/public/' . $pdfFileName);
        $pdf->save($pdfFilePath);

        // Memberikan respons kepada pengguna dengan file PDF yang diunduh
        return response()->download($pdfFilePath)->deleteFileAfterSend(true);
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role_id == 1) {
            $transactions = Transaction::all();
        } else {
            $transactions = Transaction::whereHas('user', function ($query) use ($user) {
                $query->where('name', $user->name);
            })->get();
        }

        return view('dashboard.transaksi.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, User $user, Rent $rent)
    {
        if ($request->ajax()) {
            $rent = Rent::find($request->id);
            return response()->json($rent);
        }

        $rents = Rent::whereIn('status_kontrakan', ['Kosong', 'Booking'])->get();
        $users = User::all();
        $allFull = $rents->every(function ($rent) {
            return $rent->status_kontrakan == 'Penuh';
        });

        return view('dashboard.transaksi.create', compact('rents', 'users', 'allFull'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request)
    {
        // Cetak data yang terkirim ke konsol
        // dd($request->all());
    
        if ($request->hasFile("gambar_transaksi")) {
            $gambarTransaksi = $request->file("gambar_transaksi")->getClientOriginalName();
            $request->gambar_transaksi->move(public_path('/assets/upload/gambar_transaksi/'), $gambarTransaksi);
        }
    
        $data = $request->except("gambar_transaksi");
        $data["gambar_transaksi"] = $gambarTransaksi;
        $transaction = Transaction::create($data);
    
        $rent = Rent::find($request->rent_id);
    
        // Periksa role_id dan status_transaksi
        if (auth()->user()->role_id == 1 && $transaction->status_transaksi == 'Sudah Divalidasi') {
            $rent->update(['status_kontrakan' => 'Penuh']);
        } elseif ((auth()->user()->role_id == 1 || auth()->user()->role_id == 2) && $transaction->status_transaksi == 'Belum Divalidasi') {
            $rent->update(['status_kontrakan' => 'Booking']);
        }
    
        $rent->save();
    
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => $transaction->id,
            'deskripsi' => 'Tambah Data Transaksi',
            'created_at' => now(),
        ]);
    
        Alert::success('Tambah Data Transaksi Berhasil', 'Data Transaksi Sudah Di Tambah !!!');
        return redirect()->route('dashboard.transactions.index')->with('status', 'Data Transaksi Berhasil Di Tambah!');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Request $request, Transaction $transaction, Rent $rent, User $user)
    {
        return view('dashboard.transaksi.detail', compact('request', 'transaction', 'rent', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Transaction $transaction, Rent $rent, User $user)
    {
        if ($request->ajax()) {
            $rent = Rent::find($request->id);
            return response()->json($rent);
        }

        $rents = Rent::whereIn('status_kontrakan', ['Kosong'])->get();
        $users = User::all();
        $allFull = $rents->every(function ($rent) {
            return $rent->status_kontrakan == 'Penuh';
        });

        $rents = Rent::all();
        $users = User::all();

        return view('dashboard.transaksi.edit', compact('transaction', 'rents', 'users', 'allFull'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionUpdateRequest $request, Transaction $transaction)
    {
        
        // Upload File
        if ($request->hasFile("gambar_transaksi")) {
            $gambarTransaksi = $request->file("gambar_transaksi");
            $gambarTransaksi->move(public_path('/assets/upload/gambar_transaksi'), $gambarTransaksi->getClientOriginalName());
            $transaction->update(["gambar_transaksi" => $gambarTransaksi->getClientOriginalName()]);
        }

        // Periksa apakah kontrakan dipilih telah berubah
        if ($transaction->rent_id != $request->rent_id) {
            // Jika kontrakan baru dipilih
            if ($request->rent_id) {
                // Perbarui status kontrakan lama menjadi kosong
                $oldRent = Rent::find($transaction->rent_id);
                $oldRent->update(['status_kontrakan' => 'Kosong']);

                // Perbarui status kontrakan baru menjadi penuh
                $newRent = Rent::find($request->rent_id);
                $newRent->update(['status_kontrakan' => 'Penuh']);
            }
        }

        // Update data transaksi
        $transaction->update($request->except("gambar_transaksi"));

        // Tambahan logika untuk memeriksa role_id dan status_transaksi
        if (auth()->user()->role_id == 1 && $transaction->status_transaksi == 'Sudah Divalidasi') {
            $rent = Rent::find($transaction->rent_id);
            $rent->update(['status_kontrakan' => 'Penuh']);
        } elseif (auth()->user()->role_id == 1 && $transaction->status_transaksi == 'Belum Divalidasi') {
            $rent = Rent::find($transaction->rent_id);
            $rent->update(['status_kontrakan' => 'Booking']);
        }

        // Buat log aktivitas
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'transactions',
            'id_referensi' => $transaction->id,
            'deskripsi' => 'Update Data Transaksi',
            'updated_at' => now(),
        ]);

        // Tampilkan pesan sukses
        Alert::success('Ubah Data Transaksi Berhasil', 'Data Transaksi Sudah Diubah !!!');
        return redirect()->route('dashboard.transactions.index')->with('status', 'Data Transaksi Berhasil Diubah!');
    }


    public function destroy(string $id)
    {
        // transaksi gaboleh ada delete
    }
}
