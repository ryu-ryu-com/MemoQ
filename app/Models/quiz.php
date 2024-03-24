<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'knowledge_memo_id',
        'quiz_category_id',
        'question',
        'answer',
    ];

    public function knowledgeMemo()
    {
        return $this->belongsTo(KnowledgeMemo::class);
    }

    public function quizCategory()
    {
        return $this->belongsTo(QuizCategory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
