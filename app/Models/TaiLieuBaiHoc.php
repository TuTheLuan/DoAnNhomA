<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiLieuBaiHoc extends Model
{
    use HasFactory;

    // Tên bảng nếu khác với tên mặc định suy đoán của Laravel (tức là không phải "tai_lieu_bai_hocs")
    protected $table = 'tai_lieu_baihoc';

    // Các cột được phép gán giá trị hàng loạt
    protected $fillable = ['baihoc_id', 
    'file', 
    'original_name'];


    /**
     * Mỗi tài liệu bài học thuộc về một bài học.
     */
    public function baiHoc()
    {
        return $this->belongsTo(BaiHoc::class, 'baihoc_id');
    }
}
