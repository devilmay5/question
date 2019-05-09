<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionTitle extends Model
{
    //
    protected $table = "question_title";

    public function question_list()
    {
        $this->hasMany(QuestionTitle::class,"title_id","id");
    }
}
