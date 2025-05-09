<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThongBao extends Model
{
    use HasFactory;

    protected $table = 'thongbao';

    protected $fillable = [
        'tieu_de',
        'noi_dung',
        'ngay_tao',
    ];

    public $timestamps = true;
}
