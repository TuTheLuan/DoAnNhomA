<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhoaHoc;
use Faker\Factory as Faker;

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhoaHoc;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class KhoaHocTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');

        // Disable foreign key checks temporarily
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ trong bảng khoahoc
        KhoaHoc::truncate();

        for ($i = 1; $i <= 100; $i++) {
            KhoaHoc::create([
                'ma' => 'KH' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'ten' => 'Khóa học demo ' . $i,
                'giangvien' => 'Giảng viên demo',
                'sobaihoc' => $faker->numberBetween(5, 20),
                'anh' => null,
            ]);
        }

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}

