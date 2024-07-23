<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Occupant;
use App\Models\User;
use App\Models\Role;
use App\Models\Transaction;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Requests\OccupantStoreRequest;
use App\Http\Requests\OccupantUpdateRequest;
use Illuminate\Support\Str;

class OccupantController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $occupants = Occupant::all();
        // dd($occupants);
        return view('dashboard.penghuni.index', compact('occupants', 'user'));
    }

    // route tombol tambah
    public function create()
    {
        $user = auth()->user();
        return view('dashboard.penghuni.create', 'user');
    }

    public function store(OccupantStoreRequest $request)
    {
        // dd($request->all());
        // Upload File 
        if ($request->hasFile("gambar_ktp")) {
            $gambarKtp = $request->file("gambar_ktp")->getClientOriginalName();
            $request->gambar_ktp->move(public_path('/assets/upload/gambar_ktp/'), $gambarKtp);
        }
        $data = $request->except("gambar_ktp");
        $data["gambar_ktp"] = $gambarKtp;
        // Menyertakan role_id yang sudah ditentukan (2)
        $data['role_id'] = 2;

        $user = User::create([
            'role_id' => $data['role_id'], // Mengatur role_id
            'name' => $data['nama_penghuni'],
            'email' => $data['nama_penghuni'] . '@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'),
            'remember_token' => Str::random(10),
        ]);
        $data['user_id'] = $user->id;

        $occupant = Occupant::create($data);

        // insert ke tabel log activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'occupants',
            'id_referensi' => $occupant->id,
            'deskripsi' => 'Tambah Data Penghuni',
            'created_at' => now(),
        ]);


        Alert::success('Tambah Data Penghuni Berhasil', 'Data Penghuni Sudah Di Tambah !!!');
        return redirect()->route('dashboard.occupants.index')->with('status', 'Data Penghuni Berhasil Di Tambah!');
    }


    public function edit(Occupant $occupant)
    {
        // dd($occupant);
        $user = auth()->user();
        return view('dashboard.penghuni.edit', compact('occupant', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OccupantUpdateRequest $request, Occupant $occupant)
    {
        // Upload File
        if ($request->hasFile("gambar_ktp")) {
            $gambarKtp = $request->file("gambar_ktp");
            $gambarKtp->move(public_path('/assets/upload/gambar_ktp'), $gambarKtp->getClientOriginalName());
            $occupant->update(["gambar_ktp" => $gambarKtp->getClientOriginalName()]);
        }

        // Menyertakan role_id yang sudah ditentukan (2)
        $data = $request->all();
        $data['role_id'] = 2;


        // Mengakses objek User terkait dan memperbarui datanya
        $user = $occupant->user;
        $user->update([
            'role_id' => $data['role_id'],
            'name' => $data['nama_penghuni'],
            'email' => $data['nama_penghuni'] . '@gmail.com',
            'email_verified_at' => now(), // Memastikan email_verified_at diisi
            'password' => bcrypt('12345678'),  // Pastikan ini adalah kebutuhan bisnis Anda
            'remember_token' => Str::random(10),
            'updated_at' => now(),
        ]);

        //jika tidak ada file foto, ya sudah update saja semua
        $occupant->update($request->except("gambar_ktp"));

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'occupants',
            'id_referensi' => $occupant->id,
            'deskripsi' => 'Update Data Penghuni',
        ]);

        alert()->success('Edit Data Penghuni Berhasil', 'Data Penghuni Sudah Di Ubah !!!');
        return redirect()->route("dashboard.occupants.index")->with('status', 'Data Penghuni Berhasil Di Ubah!');
    }

    public function show(Request $request, Occupant $occupant, User $user)
    {
        $user = auth()->user();
        $users = User::all();
        return view('dashboard.penghuni.show', compact('request', 'occupant', 'users', 'user'));
    }

    public function destroy(Occupant $occupant)
    {
        $occupantId = $occupant->id;
    
        // Pastikan tidak ada transaksi yang masih aktif terkait occupant ini
        $activeTransactions = Transaction::where('occupant_id', $occupantId)->get();
    
        if ($activeTransactions->isNotEmpty()) {
            Alert::error('Error', 'Penghuni ini masih memiliki transaksi aktif.');
            return redirect()->route('dashboard.occupants.index')->with('error', 'Penghuni ini masih memiliki transaksi aktif.');
        }
    
         
        // Hapus occupant
        $deleted = $occupant->delete();
    
        if (!$deleted) {
            Log::error('Error when deleting occupant: Unable to delete occupant with ID ' . $occupantId);
            Alert::error('Error', 'Terjadi kesalahan saat menghapus data.');
            return redirect()->route('dashboard.occupants.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    
        // Insert ke tabel log activity
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'tabel_referensi' => 'occupants',
            'id_referensi' => $occupantId,
            'deskripsi' => 'Hapus Data Penghuni',
            'created_at' => now(),
        ]);
    
        Alert::success('Hapus Data Penghuni Berhasil', 'Data Penghuni Sudah Dihapus !!!');
        return redirect()->route('dashboard.occupants.index')->with('status', 'Data Penghuni Berhasil Dihapus!');
    }
    
    
}
