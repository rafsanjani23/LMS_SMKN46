<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class RecapExport implements FromArray, WithHeadings, WithStyles, WithTitle
{
    protected $recap;
    protected $materialIds;
    protected $classroom;

    public function __construct($recap, $materialIds, $classroom)
    {
        $this->recap = $recap;
        $this->materialIds = $materialIds;
        $this->classroom = $classroom;
    }

    public function array(): array
    {
        $data = [];
    
        foreach ($this->recap as $index => $student) {
            $row = [
                $index + 1,             // Kolom "No."
                $student['name'],       // Kolom "Student Name"
            ];
    
            foreach ($student['tasks'] as $score) {
                $row[] = $score;
            }
    
            $row[] = $student['average'];
            $row[] = $student['max'];
            $row[] = $student['min'];
    
            $data[] = $row;
        }
    
        return $data;
    }
    

    public function headings(): array
    {
        $headings = ['No.', 'Student Name'];

        foreach ($this->materialIds as $index => $id) {
            $headings[] = 'Tugas ' . ($index + 1);
        }

        $headings[] = 'Rata-Rata';
        $headings[] = 'Max';
        $headings[] = 'Min';

        return $headings;
    }

    public function styles(Worksheet $sheet)
    {
        // Tambahkan judul di baris 1
        $sheet->insertNewRowBefore(1, 1);
        $title = 'Grade Recap From ' . $this->classroom->title . ' Class';
        $columnCount = count($this->headings());

        $sheet->mergeCellsByColumnAndRow(1, 1, $columnCount, 1);
        $sheet->setCellValue('A1', $title);

        // Judul format
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);

        // Border semua tabel (header + data)
        $totalRows = count($this->recap) + 2; // 1 row title + 1 row heading + data
        $range = 'A2:' . $sheet->getHighestColumn() . $totalRows;

        $sheet->getStyle($range)->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $sheet->getStyle('A2:A' . $totalRows)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

        return [];
    }

    public function title(): string
    {
        return 'Grade Recap';
    }
}
