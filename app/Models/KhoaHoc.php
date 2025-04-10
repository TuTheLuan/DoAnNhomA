<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    use HasFactory;

    protected $table = 'khoahoctb'; // Tên bảng tương ứng trong database
    public $timestamps = false; // Vì `created_at`, `updated_at` đang NULL
    protected $fillable = [
        'ma',        // 
        'ten',
        'giangvien',
        'sobaihoc',
    ];
}
