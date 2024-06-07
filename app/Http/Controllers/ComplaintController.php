<?php
namespace App\Http\Controllers;

use App\Http\Requests\ComplaintStoreRequest;
use App\Http\Requests\ComplaintUpdateRequest;
use App\Models\Complaint;
use App\Models\User;
use App\Models\Rent;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use RealRashid\SweetAlert\Facades\Alert;



class ComplaintController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id == 1) {
            $complaints = Complaint::all();
        } else {
            $complaints = Complaint::whereHas('user', function ($query) use ($user) {
                $query->where('name', $user->name);
            })->get();
        }

        return view('dashboard.keluhan.index', compact('complaints'));
    }

    public function create(Request $request, User $user, Rent $rent)
    {
        $rents = Rent::all();
        $users = User::all();

        return view('dashboard.keluhan.create', compact('users', 'rents'));
    }

    public function store(ComplaintStoreRequest $request)
    {
        // Validasi data
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'rent_id' => 'required|exists:rents,id',
            'keluhan' => 'required|string',
            'gambar_keluhan' => 'nullable|image|max:2048',
        ]);

        // dd($request->all());

        // Proses upload gambar
        $gambarKeluhan = null;
        if ($request->hasFile("gambar_keluhan")) {
            $gambarKeluhan = $request->file("gambar_keluhan")->getClientOriginalName();
            $request->gambar_keluhan->move(public_path('/assets/upload/gambar_keluhan/'), $gambarKeluhan);
        }

        // Buat keluhan baru
        $complaint = Complaint::create([
            'user_id' => $request->user_id,
            'rent_id' => $request->rent_id,
            'keluhan' => $request->keluhan,
            'status_keluhan' => $request->status_keluhan,
            'gambar_keluhan' => $gambarKeluhan,
        ]);

        // Log aktivitas
        ActivityLog::create([
            'user_id' => Auth::id(),
            'tabel_referensi' => 'complaints',
            'id_referensi' => $complaint->id,
            'deskripsi' => 'Tambah Data Keluhan',
            'created_at' => now(),
        ]);

        // Alert sukses
        Alert::success('Tambah Data Keluhan Berhasil', 'Data Keluhan Sudah Di Tambah !!!');

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard.complaints.index')->with('success', 'Keluhan berhasil ditambahkan');
    }

    public function show(Request $request, Rent $rent, User $user, Complaint $complaint)
    {
        return view('dashboard.keluhan.detail', compact('request','complaint', 'user', 'rent'));
    }
 
    public function detail(Request $request, Rent $rent, User $user, Complaint $complaint)
    {
        return view('dashboard.homepage.detail_keluhan', compact('request','complaint', 'user', 'rent'));
    }

    public function edit(Request $request, Complaint $complaint, User $user, Rent $rent)
    {
        $rents = Rent::all();
        $users = User::all();

        return view('dashboard.keluhan.edit', compact('complaint', 'users', 'rents'));
    }

    public function update(ComplaintUpdateRequest $request, Complaint $complaint)
    {
        $request->validate([
            'rent_id' => 'required|exists:rents,id',
            'keluhan' => 'required|string',
            'gambar_keluhan' => 'nullable|image|max:2048',
            'status_keluhan' => 'required|in:Sudah Divalidasi,Belum Divalidasi',
        ]);

        $gambar_keluhan = $complaint->gambar_keluhan;
        if ($request->hasFile('gambar_keluhan')) {
            if ($gambar_keluhan) {
                Storage::delete($gambar_keluhan);
            }
            $gambar_keluhan = $request->file('gambar_keluhan')->store('keluhan_images');
        }

        $complaint->update([
            'rent_id' => $request->rent_id,
            'keluhan' => $request->keluhan,
            'gambar_keluhan' => $gambar_keluhan,
            'status_keluhan' => $request->status_keluhan,
        ]);

        return redirect()->route('dashboard.complaints.index')->with('success', 'Keluhan berhasil diupdate');
    }

    public function destroy(Complaint $complaint)
    {
        if ($complaint->gambar_keluhan) {
            Storage::delete($complaint->gambar_keluhan);
        }
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Keluhan berhasil dihapus');
    }
}
