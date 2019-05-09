<?php
namespace App\Services;

use App\QuestionTitle;
use DB;

class QuestionService
{
    public static function getTitleList()
    {
       return QuestionTitle::query()->pluck("name","id");
    }
}