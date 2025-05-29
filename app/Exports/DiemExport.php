<?php

namespace App\Exports;

use App\Models\KhoaHoc;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class DiemExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $khoahocId;
    protected $maxBaiTap;

    public function __construct($khoahocId)
    {
        $this->khoahocId = $khoahocId;
        
        // Tìm số bài tập lớn nhất
        $this->maxBaiTap = DB::table('diem_bai_taps')
            ->where('khoahoc_id', $khoahocId)
            ->max('bai_so') ?? 0;
    }

    public function collection()
    {
        return Student::query()
            ->join('user_khoahoc', 'students.id', '=', 'user_khoahoc.user_id')
            ->where('user_khoahoc.khoahoc_id', $this->khoahocId)
            ->where('students.trang_thai', true)
            ->select('students.*')
            ->get();
    }

    public function headings(): array
    {
        $headers = [
            'ID',
            'Họ và tên',
            'Email',
        ];

        // Thêm cột điểm cho từng bài tập
        for ($i = 1; $i <= $this->maxBaiTap; $i++) {
            $headers[] = "Bài $i";
        }

        // Thêm cột điểm thi và điểm tổng kết
        $headers[] = 'Điểm thi';
        $headers[] = 'Điểm tổng kết';

        return $headers;
    }

    public function map($student): array
    {
        // Lấy điểm bài tập
        $diemBaiTap = DB::table('diem_bai_taps')
            ->where('student_id', $student->id)
            ->where('khoahoc_id', $this->khoahocId)
            ->pluck('diem', 'bai_so')
            ->toArray();

        // Lấy điểm thi
        $diemThi = DB::table('diem_this')
            ->where('student_id', $student->id)
            ->where('khoahoc_id', $this->khoahocId)
            ->value('diem') ?? 0;

        $row = [
            $student->id,
            $student->name,
            $student->email,
        ];

        // Thêm điểm từng bài tập
        for ($i = 1; $i <= $this->maxBaiTap; $i++) {
            $row[] = $diemBaiTap[$i] ?? '-';
        }

        // Thêm điểm thi
        $row[] = $diemThi;

        // Tính và thêm điểm tổng kết
        $diemBaiTapTrungBinh = !empty($diemBaiTap) ? array_sum($diemBaiTap) / count($diemBaiTap) : 0;
        $diemTongKet = $diemBaiTapTrungBinh * 0.3 + $diemThi * 0.7;
        $row[] = number_format($diemTongKet, 1);

        return $row;
    }

    public function styles(Worksheet $sheet)
    {
        // Style cho header
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F81BD']
            ]
        ]);

        // Auto-size các cột
        foreach(range('A', $sheet->getHighestColumn()) as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Căn giữa các cột điểm
        $lastCol = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle('D2:' . $lastCol . $lastRow)->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);

        return $sheet;
    }
} 