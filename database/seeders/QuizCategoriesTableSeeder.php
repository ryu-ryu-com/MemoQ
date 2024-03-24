<?php

namespace Database\Seeders;

use App\Models\QuizCategory;
use Illuminate\Database\Seeder;

class QuizCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        QuizCategory::query()->create([
            'name' => '雑学',
            'description' => 'トリビアや生活の知識',
        ]);

        QuizCategory::query()->create([
            'name' => '歴史学',
            'description' => '日本史・世界史から',
        ]);

        QuizCategory::query()->create([
            'name' => '物理学',
            'description' => '高校物理まで',
        ]);

        QuizCategory::query()->create([
            'name' => '論理学',
            'description' => '書籍で学んだものを中心に',
        ]);

        QuizCategory::query()->create([
            'name' => '構造認識学',
            'description' => 'モデルやシミュレーションを用いて',
        ]);

        QuizCategory::query()->create([
            'name' => '数学',
            'description' => '主に高校数学まで',
        ]);
    }
}
