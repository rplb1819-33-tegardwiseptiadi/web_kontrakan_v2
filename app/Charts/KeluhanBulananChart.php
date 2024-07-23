<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Complaint; // Menambahkan impor class Complaint
use Illuminate\Support\Facades\Auth; // Impor untuk mendapatkan data pengguna yang sedang login

class KeluhanBulananChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = 12; // Loop until December
        $dataTotalKeluhan = [];
        $dataBulan = []; // Array to store month names
        
        $user = Auth::user(); // Dapatkan data pengguna yang sedang login
        $isAdmin = $user->role->name === 'administrator'; // Periksa apakah pengguna adalah administrator

        for ($i = 1; $i <= $bulan; $i++) {
            $query = Complaint::whereYear('created_at', $tahun)
                              ->whereMonth('created_at', $i);
            
            if (!$isAdmin) {
                // Jika pengguna bukan administrator, tambahkan filter berdasarkan user_id
                $query->where('user_id', $user->id);
            }
            
            $totalKeluhan = $query->count(); // Hitung total keluhan untuk setiap bulan
            $dataBulan[] = date('F', mktime(0, 0, 0, $i, 1)); // Convert month number to month name
            $dataTotalKeluhan[] = $totalKeluhan;
        }

        return $this->chart->lineChart()
            ->setTitle('Jumlah Keluhan Bulanan')
            ->setSubtitle('Total Keluhan Setiap Bulan')
            ->addData('Total Keluhan', $dataTotalKeluhan)
            ->setHeight(270)
            ->setXAxis($dataBulan);
    }
}
