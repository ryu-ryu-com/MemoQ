<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KnowledgeMemo;

class KnowledgeMemosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル１',
            'content' => 'コンテンツ内容１',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル２',
            'content' => 'コンテンツ内容２',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル３',
            'content' => 'コンテンツ内容３',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 2,
            'title' => 'メモタイトル４',
            'content' => 'コンテンツ内容４',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル５',
            'content' => 'コンテンツ内容５',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 2,
            'title' => 'メモタイトル６',
            'content' => 'コンテンツ内容６',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル７',
            'content' => 'コンテンツ内容７',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル８',
            'content' => 'コンテンツ内容８',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル９',
            'content' => 'コンテンツ内容９',
            'is_publish' => 0,
        ]);

        KnowledgeMemo::query()->create([
            'user_id' => 1,
            'title' => 'メモタイトル１０',
            'content' => 'コンテンツ内容１０',
            'is_publish' => 0,
        ]);
    }
}
