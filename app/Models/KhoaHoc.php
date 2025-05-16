<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoaHoc extends Model
{
    use HasFactory;

    protected $table = 'khoahoctb'; // Tên bảng tương ứng trong database
    public $timestamps = false; // Nếu bạn không dùng created_at, updated_at

    protected $fillable = [
        'ma',
        'ten',
        'giangvien',
        'sobaihoc',
        'anh',
        'meet_link',     // Link Google Meet
        'meet_time',     // Thời gian học
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_khoahoc');
    }

    public function baiHocs()
    {
        return $this->hasMany(BaiHoc::class, 'khoahoc_id');
    }
}
