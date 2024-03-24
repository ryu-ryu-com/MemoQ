<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizzesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Quiz::query()->create([
            'user_id' => "1",
            'knowledge_memo_id' => "1",
            'quiz_category_id' => "1",
            'question' => '今何問目？',
            'answer' => '１問目',
        ]);

        Quiz::query()->create([
            'user_id' => "1",
            'knowledge_memo_id' => "1",
            'quiz_category_id' => "1",
            'question' => '今何問目？',
            'answer' => '２問目',
        ]);

        Quiz::query()->create([
            'user_id' => "1",
            'knowledge_memo_id' => "2",
            'quiz_category_id' => "2",
            'question' => '今何問目？',
            'answer' => '３問目',
        ]);

        Quiz::query()->create([
            'user_id' => "1",
            'knowledge_memo_id' => "1",
            'quiz_category_id' => "2",
            'question' => '今何問目？',
            'answer' => '４問目',
        ]);
    }
}
