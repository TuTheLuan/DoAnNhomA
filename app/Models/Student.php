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
    ];

    public $timestamps = true;

}

