<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Complaint; // Menambahkan impor class Complaint

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

        for ($i = 1; $i <= $bulan; $i++) {
            $totalKeluhan = Complaint::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count(); // Count total complaints for each month
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