<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diendan;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class DiendanTableSeeder extends Seeder
{
    public function run()
{
    $faker = Faker::create('vi_VN');

    // Tắt kiểm tra khóa ngoại
    \DB::statement('SET FOREIGN_KEY_CHECKS = 0;');

    // Xóa dữ liệu cũ trong bảng diendan_messages trước nếu cần
    // \App\Models\DiendanMessage::truncate(); // nếu cần, hoặc dùng DB::table('diendan_messages')->truncate();

    // Xóa dữ liệu cũ trong bảng diendan
    \App\Models\Diendan::truncate();

    // Bật lại kiểm tra khóa ngoại
    \DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

    for ($i = 1; $i <= 100; $i++) {
        Diendan::create([
            'ma_dien_dan' => 'DD' . str_pad($i, 3, '0', STR_PAD_LEFT),
            'ten_dien_dan' => 'Môn demo ' . $i,
            'loai_thao_luan' => $faker->randomElement(['public', 'anonymous']),
            'ngay_tao' => $faker->date(),
            'ten_giang_vien' => 'Huỳnh Thái Quốc',
            'background_image' => null,
            'images' => null,
        ]);
    }
}

}
