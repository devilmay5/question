<?php

use Illuminate\Database\Seeder;

class QuestionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       factory(App\QuestList::class, 100)->create();


//        factory(App\QuestionTitle::class, 1)->create()->each(function ($question_title) {
//
//            $question_title->question_list()->save(factory(App\QuestList::class)->make());
//        });
    }
}
