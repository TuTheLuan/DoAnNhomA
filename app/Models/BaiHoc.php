<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaiHoc extends Model
{
    use HasFactory;

    protected $table = 'bai_hocs';

    protected $fillable = ['so', 'tieude', 'file', 'khoahoc_id'];

    public function taiLieu()
    {
        return $this->hasMany(TaiLieuBaiHoc::class, 'baihoc_id');
    }

}
