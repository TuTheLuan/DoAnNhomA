<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diendan extends Model
{
    use HasFactory;

    protected $casts = [
        'images' => 'array'
    ];

    protected $table = 'diendan';
    protected $fillable = [
        'ma_dien_dan',
        'ten_dien_dan',
        'loai_thao_luan',
        'background_image',
        'images',
        'ngay_tao',
        'ten_giang_vien'
    ];
}
