<?php

namespace App\Http\Controllers;

use App\QuestionTitle;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function index(){
       $title_list =  QuestionTitle::all();

       return view("question",['title_list'=>$title_list]);
    }
}
