<?php

namespace App\Http\Controllers;

use App\QuestionTitle;
use App\QuestList;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index()
    {
        $title_list = QuestionTitle::all();

        return view("question", ['title_list' => $title_list]);
    }


    public function getList($id)
    {
        $list = QuestList::where("title_id", $id)->get();

        return view("list", ['info_list' => $list]);

    }

    public function store(Request $request){
       $answer = $request->only("answer");

       $id_arr = array_keys($answer['answer']);

       $true_list =  QuestList::whereIn("id", $id_arr)->pluck("answer_true","id")->toArray();

       $dadui = array_intersect_assoc($true_list,$answer['answer']);

       echo "正确答案\r\n";
       print_r($true_list);

        echo "您的答案\r\n";
        print_r($answer['answer']);

       echo "您本次答对".count($dadui)."道题";

    }
}
