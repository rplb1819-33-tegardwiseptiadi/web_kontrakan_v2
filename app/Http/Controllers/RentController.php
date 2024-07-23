<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use App\Models\Rent;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Requests\RentStoreRequest;
use App\Http\Requests\RentUpdateRequest;

class RentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $rents = Rent::all();
        return view('dashboard.kontrakan.index', compact('user', 'rents'));
    }
    
    // route tombol tambah
    public function create()
    {
        $user = auth()->user();
        return view('dashboard.kontrakan.create',  compact('user'));
    }

    public function store(RentStoreRequest $request)
    {
        //    dd($request->all());
        // Upload File 
        if ($request->hasFile("gambar_kontrakan")) {
            $gambarKontrakan = $request->file("gambar_kontrakan")->getClientOriginalName();
            $request->gambar_kontrakan->move(public_path('/assets/upload/gambar_kontrakan/'), $gambarKontrakan);
        }
        $data = $request->except("gambar_kontrakan");
        $data["gambar_kontrakan"] = $gambarKontrakan;
        $rent = Rent::create($data);

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'rents',
            'id_referensi' => $rent->id,
            'deskripsi' => 'Tambah Data Kontrakan',
            'created_at' => now(),
        ]);

        Alert::success('Tambah Data Kontrakan Berhasil', 'Data Kontrakan Sudah Di Tambah !!!');
        return redirect()->route('dashboard.rents.index')->with('status', 'Data Kontrakan Berhasil Di Tambah!');
    }

    public function edit(Rent $rent)
    {
        $user = auth()->user();
        return view('dashboard.kontrakan.edit', compact('rent', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RentUpdateRequest $request, Rent $rent)
    {
        // Upload File
        if ($request->hasFile("gambar_kontrakan")) {
            $gambarKontrakan = $request->file("gambar_kontrakan");
            $gambarKontrakan->move(public_path('/assets/upload/gambar_kontrakan'), $gambarKontrakan->getClientOriginalName());
            $rent->update(["gambar_kontrakan" => $gambarKontrakan->getClientOriginalName()]);
        }
        //jika tidak ada file foto, ya sudah update saja semua
        $rent->update($request->except("gambar_kontrakan"));

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'rents',
            'id_referensi' => $rent->id,
            'deskripsi' => 'Update Data Kontrakan',
            'updated_at' => now(),
        ]);

        alert()->success('Edit Data Kontrakan Berhasil', 'Data Kontrakan Sudah Di Ubah !!!');
        return redirect()->route("dashboard.rents.index")->with('status', 'Data Kontrakan Berhasil Di Ubah!');
    }

    public function show(Request $request, Rent $rent)
    {
        $user = auth()->user();
        return view('dashboard.kontrakan.detail', compact('request', 'rent', 'user'));
    }

    public function destroy(Rent $rent)
    {
        try {
            $rentId = $rent->id; // Simpan ID sebelum dihapus
    
            // Pastikan tidak ada transaksi yang masih aktif terkait rent ini
            $activeTransactions = Transaction::where('rent_id', $rentId)->get();
    
            if ($activeTransactions->isNotEmpty()) {
                Alert::error('Error', 'Kontrakan ini masih memiliki data transaksi & data keluhan aktif.');
                return redirect()->route('dashboard.rents.index')->with('Error', 'Data Kontrakan Gagal Di Hapus!.');
            }
    
            $rent->delete();
    
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'tabel_referensi' => 'rents',
                'id_referensi' => $rentId,
                'deskripsi' => 'Hapus Data Kontrakan',
                'created_at' => now(), // Assuming you want to log the deletion time
            ]);
    
            Alert::success('Hapus Data Kontrakan Berhasil', 'Data Kontrakan Sudah Dihapus !!!');
            return redirect()->route('dashboard.rents.index')->with('status', 'Data Kontrakan Berhasil Dihapus!');
        } catch (\Exception $e) {
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
            return redirect()->route('dashboard.rents.index')->with('Error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
    
}
