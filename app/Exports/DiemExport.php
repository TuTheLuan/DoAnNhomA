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
            ->select(DB::raw('MAX(bai_so) as max_bai'))
            ->where('khoahoc_id', $khoahocId)
            ->value('max_bai') ?? 5; // Mặc định là 5 nếu không có dữ liệu
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
            'Mã học viên',
            'Họ và tên',
            'Email',
        ];

        // Thêm cột điểm cho từng bài tập
        for ($i = 1; $i <= $this->maxBaiTap; $i++) {
            $headers[] = "Bài tập $i";
        }

        // Thêm cột điểm thi
        $headers[] = 'Điểm thi';

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
            ->value('diem') ?? '-';

        $row = [
            $student->ma_hoc_vien ?? 'HV' . $student->id,
            $student->ho_ten,
            $student->email,
        ];

        // Thêm điểm từng bài tập
        for ($i = 1; $i <= $this->maxBaiTap; $i++) {
            $row[] = $diemBaiTap[$i] ?? '-';
        }

        // Thêm điểm thi
        $row[] = $diemThi;

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