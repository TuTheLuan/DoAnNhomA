<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KhoaHoc;
use App\Models\Student;

class DiemBaiTap extends Model
{
    protected $fillable = ['student_id', 'bai_so', 'diem', 'khoahoc_id'];

    public function khoahoc()
    {
        return $this->belongsTo(KhoaHoc::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

