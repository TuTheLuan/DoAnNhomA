<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    // Khai báo các trường có thể gán giá trị bằng cách mass-assignment
    protected $fillable = [
        'ho_ten',
        'gioi_tinh',
        'email',
        'dia_chi',
        'trang_thai',
    ];

    public $timestamps = true;

    // Student.php

    public function diemBaiTap()
    {
        return $this->hasMany(DiemBaiTap::class);
    }

    public function diemThi()
    {
        return $this->hasOne(DiemThi::class);
    }

    // Define the many-to-many relationship with KhoaHoc
    public function khoaHocs()
    {
        return $this->belongsToMany(KhoaHoc::class, 'user_khoahoc', 'user_id', 'khoahoc_id');
    }
}

