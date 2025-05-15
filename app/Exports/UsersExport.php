<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Peminjaman::with('user', 'barang')->get()->map(function ($peminjaman) {
            return [
                'Nama Peminjam' => $peminjaman->user->name,
                'Barang Yang Dipinjam' => $peminjaman->barang->nama_barang,
                'Tanggal Peminjaman' => $peminjaman->tanggal_pinjam,
                'Tanggal Kembali' => $peminjaman->tanggal_kembali,
                'Status' => $peminjaman->status,
                'Jumlah' => $peminjaman->jumlah,
                'Kondisi' => $peminjaman->kondisi,
                'Catatan' => $peminjaman->catatan,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Peminjam',
            'Barang Yang Dipinjam',
            'Tanggal Peminjaman',
            'Tanggal Kembali',
            'Status',
            'Jumlah',
            'Kondisi',
            'Catatan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Bold headings
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        // Font settings untuk seluruh sheet
        $sheet->getParent()->getDefaultStyle()->getFont()
            ->setName('Times New Roman')
            ->setSize(12);

        // Alignment untuk heading
        $sheet->getStyle('A1:H1')->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER)
            ->setVertical(Alignment::VERTICAL_CENTER);

        // Border seluruh isi
        $sheet->getStyle('A1:H' . $sheet->getHighestRow())
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);
    }
}