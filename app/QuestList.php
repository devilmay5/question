<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestList extends Model
{
    //
    protected $table = "question_list";

    const ANSWER = [
        "A" => 'A',
        "B" => 'B',
        "C" => 'C',
        "D" => 'D',
    ];

    public function question_title(): BelongsTo
    {
        $this->belongsTo(QuestionTitle::class, "title_id", "id");
    }
}
