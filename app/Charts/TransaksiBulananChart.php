<?php

namespace App\Charts;

use App\Models\Transaction; // Menambahkan impor class Transaction
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransaksiBulananChart
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
        $dataTotalTransaksi = [];
        $dataBulan = []; // Array to store month numbers
    
        for ($i = 1; $i <= $bulan; $i++) {
            $totalTransaksi = Transaction::whereYear('created_at', $tahun)
                ->whereMonth('tgl_transaksi', $i)
                ->sum('total_harga');
            $dataBulan[] = date('F', mktime(0, 0, 0, $i, 1)); // Convert month number to month name
            $dataTotalTransaksi[] = $totalTransaksi;
        }
    
        return $this->chart->lineChart()
            ->setTitle('Data Transaksi Bulanan.')
            ->setSubtitle('Total Transaksi Setiap Bulan ')
            ->setColors(['#15CC18']) // Set line color to green
            ->addData('Physical sales', $dataTotalTransaksi)
            ->setHeight(270)
            ->setXAxis($dataBulan);
    }
    
}
