<?php

namespace App\Exports;

use pxlrbt\FilamentExcel\Exports\ExcelExport;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class DistrikExport extends ExcelExport implements WithDrawings, WithCustomStartCell
{
    public function setUp(): void
    {
        $this->withFilename('Data_Distrik_' . now()->format('Y-m-d'));
    }

    public function startCell(): string
    {
        return 'A8';
    }

    public function drawings(): array
    {
        $drawing = new Drawing();
        $drawing->setName('Logo DPPKP');
        $drawing->setDescription('Logo Dinas Pertanian dan Perkebunan');
        $drawing->setPath(public_path('img/logo-dppkp-land.png'));
        $drawing->setHeight(80);
        $drawing->setCoordinates('A1');
        $drawing->setOffsetX(10);
        $drawing->setOffsetY(5);

        return [$drawing];
    }

    public function registerEvents(): array
    {
        $parentEvents = parent::registerEvents();

        return array_merge($parentEvents, [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $lastColumn = $sheet->getHighestColumn();

                // Merge cells untuk header kop surat
                $sheet->mergeCells("B1:{$lastColumn}1");
                $sheet->mergeCells("B2:{$lastColumn}2");
                $sheet->mergeCells("B3:{$lastColumn}3");
                $sheet->mergeCells("B4:{$lastColumn}4");

                // Set value header
                $sheet->setCellValue('B1', 'PEMERINTAH KABUPATEN MERAUKE');
                $sheet->setCellValue('B2', 'DINAS TANAMAN PANGAN, HORTIKULTURA DAN PERKEBUNAN');
                $sheet->setCellValue('B3', 'Alamat : Jl. A. Yani Merauke, Telp. (0971) 321524, Fax. (0971) 323875, E-mail : tph-mrk@yahoo.co.id');
                $sheet->setCellValue('B4', 'Kode Pos : 99616');

                // Style header - baris 1
                $sheet->getStyle("B1:{$lastColumn}1")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                        'name' => 'Times New Roman',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Style header - baris 2
                $sheet->getStyle("B2:{$lastColumn}2")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 12,
                        'name' => 'Times New Roman',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Style header - baris 3
                $sheet->getStyle("B3:{$lastColumn}3")->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'name' => 'Times New Roman',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Style header - baris 4
                $sheet->getStyle("B4:{$lastColumn}4")->applyFromArray([
                    'font' => [
                        'size' => 10,
                        'name' => 'Times New Roman',
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Set row heights untuk header area
                $sheet->getRowDimension(1)->setRowHeight(25);
                $sheet->getRowDimension(2)->setRowHeight(22);
                $sheet->getRowDimension(3)->setRowHeight(18);
                $sheet->getRowDimension(4)->setRowHeight(18);
                $sheet->getRowDimension(5)->setRowHeight(5);

                // Garis bawah header (baris 6)
                $sheet->getStyle("A6:{$lastColumn}6")->applyFromArray([
                    'borders' => [
                        'bottom' => [
                            'borderStyle' => Border::BORDER_THICK,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Row spacer
                $sheet->getRowDimension(6)->setRowHeight(3);
                $sheet->getRowDimension(7)->setRowHeight(8);

                // Style untuk heading tabel (baris 8)
                $sheet->getStyle("A8:{$lastColumn}8")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 11,
                        'name' => 'Arial',
                        'color' => ['argb' => 'FFFFFFFF'],
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FF228B22'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => 'FF000000'],
                        ],
                    ],
                ]);

                // Style untuk data rows
                $lastRow = $sheet->getHighestRow();
                if ($lastRow > 8) {
                    $sheet->getStyle("A9:{$lastColumn}{$lastRow}")->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['argb' => 'FF000000'],
                            ],
                        ],
                        'alignment' => [
                            'vertical' => Alignment::VERTICAL_CENTER,
                        ],
                        'font' => [
                            'size' => 10,
                            'name' => 'Arial',
                        ],
                    ]);
                }
            },
        ]);
    }
}
