<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OccupantController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\RentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionReportController;
use App\Http\Controllers\ActivityLogController;
use App\Models\Rent;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $rents = Rent::all(); // Ambil semua data kontrakan
    return view('main_home', compact('rents'));
})->name('main-home');


//abaikan error routes gapapa
Auth::routes();

//route main home
Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');

Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', "middleware" => ["auth"]], function () {
    // route hak akses
    Route::resource('users', UserController::class); 
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    //route penghuni
    Route::resource('occupants', OccupantController::class);

    //route keluhan
    Route::resource('complaints', ComplaintController::class);
    Route::get('complaints/{complaint}/detail', [ComplaintController::class, 'detail'])->name('complaints.detail');


    //route kontrakan
    Route::resource('rents', RentController::class);

    //route transaksi
    Route::resource('transactions', TransactionController::class);
    Route::get('/transaction/print/bayar/{transaction}', [TransactionController::class, 'print'])->name('transaction.print');
    // Route::get('/transactions/{transaction}/print', [TransactionController::class, 'print'])->name('dashboard.transaction.print');

    Route::resource('laporan_transaksi', TransactionReportController::class);
    Route::get("print-data-laporan-form", [TransactionReportController::class, "cetakLaporanForm"])->name('laporan_transaksi.print-laporan-form');
    Route::post('print-data-laporan-pertanggal/{tglawal?}/{tglakhir?}', [TransactionReportController::class, "cetakLaporanPertanggal"])->name('laporan_transaksi.print-data-laporan-pertanggal');

    // route activity log
    Route::resource('log_activity', ActivityLogController::class);
});
