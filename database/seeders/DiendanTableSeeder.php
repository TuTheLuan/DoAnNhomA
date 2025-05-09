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

        // Xóa dữ liệu cũ trong bảng diendan
        Diendan::truncate();

        for ($i = 1; $i <= 100; $i++) {
            Diendan::create([
                'ma_dien_dan' => 'DD' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'ten_dien_dan' => 'Môn demo ' . $i,
                'loai_thao_luan' => $faker->randomElement(['public', 'anonymous']),
                'ngay_tao' => $faker->date(),
                'ten_giang_vien' => 'Huỳnh Thái Quốc',
                'background_image' => $faker->optional()->imageUrl(640, 480, 'nature', true),
                'images' => $faker->optional()->randomElements([
                    $faker->imageUrl(640, 480, 'nature', true),
                    $faker->imageUrl(640, 480, 'people', true),
                    $faker->imageUrl(640, 480, 'abstract', true),
                ], $faker->numberBetween(1, 3), false) ? json_encode($faker->randomElements([
                    $faker->imageUrl(640, 480, 'nature', true),
                    $faker->imageUrl(640, 480, 'people', true),
                    $faker->imageUrl(640, 480, 'abstract', true),
                ], $faker->numberBetween(1, 3), false)) : null,
            ]);
        }
    }
}
