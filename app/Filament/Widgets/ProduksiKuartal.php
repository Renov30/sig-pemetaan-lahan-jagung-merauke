<?php

namespace App\Filament\Widgets;

use App\Models\Produksi;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProduksiKuartal extends ChartWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 'full';

    protected static bool $isLazy = false;

    public function getHeading(): string
    {
        // Ambil 3 tahun terakhir berdasarkan data yang ada di database
        $tahunDenganData = Produksi::select(DB::raw('DISTINCT YEAR(tanggal_produksi) as tahun'))
            ->orderBy('tahun', 'desc')
            ->limit(3)
            ->pluck('tahun')
            ->sort()
            ->values()
            ->toArray();

        if (empty($tahunDenganData)) {
            return 'Jumlah Produksi Per Kuartal';
        }

        $tahunText = implode(', ', $tahunDenganData);

        return "Jumlah Produksi Per Kuartal — Tahun {$tahunText}";
    }

    protected function getData(): array
    {
        // Ambil 3 tahun terakhir berdasarkan data yang ada di database
        $tahunList = Produksi::select(DB::raw('DISTINCT YEAR(tanggal_produksi) as tahun'))
            ->orderBy('tahun', 'desc')
            ->limit(3)
            ->pluck('tahun')
            ->sort()
            ->values()
            ->toArray();

        // Ambil data produksi per kuartal dan tahun (3 tahun terakhir dari data)
        $data = Produksi::select(
            DB::raw('QUARTER(tanggal_produksi) as kuartal'),
            DB::raw('YEAR(tanggal_produksi) as tahun'),
            DB::raw('SUM(hasil_produksi) as total_produksi')
        )
            ->whereIn(DB::raw('YEAR(tanggal_produksi)'), $tahunList)
            ->groupBy('tahun', 'kuartal')
            ->orderBy('tahun')
            ->orderBy('kuartal')
            ->get();

        // Inisialisasi label (Q1, Q2, Q3, Q4) dan data
        $labels = ['Q1', 'Q2', 'Q3', 'Q4'];
        $dataPerTahun = [];

        // Ambil tahun yang ada dari data
        $tahunList = $data->pluck('tahun')->unique();

        // Set default nilai 0 untuk setiap kuartal dalam setiap tahun
        foreach ($tahunList as $tahun) {
            $dataPerTahun[$tahun] = [0, 0, 0, 0];
        }

        // Isi data sesuai hasil query
        foreach ($data as $item) {
            $dataPerTahun[$item->tahun][$item->kuartal - 1] = (float) $item->total_produksi;
        }

        // Buat dataset berdasarkan tahun
        $datasets = [];
        $colors = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#C9CBCF']; // Warna untuk tiap tahun
        $index = 0;

        foreach ($dataPerTahun as $tahun => $values) {
            $datasets[] = [
                'label' => "Produksi Tahun {$tahun}",
                'data' => $values,
                'borderColor' => $colors[$index % count($colors)], // Ambil warna sesuai index
                'backgroundColor' => 'transparent',
                'fill' => false,
                'tension' => 0.4, // Buat garis lebih smooth
            ];
            $index++;
        }

        return [
            'labels' => $labels,
            'datasets' => $datasets,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // Menggunakan line chart
    }
}
