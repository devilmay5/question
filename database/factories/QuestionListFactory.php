<?php

use Faker\Generator as Faker;

$factory->define(\App\QuestList::class, function (Faker $faker) {
    return [
        //
        "name" => $faker->title,
        "title_id"=>function () {
            return factory(App\QuestionTitle::class)->create()->id;
        } ,
        "image_url" => $faker->imageUrl,
        "answer_A"=> $faker->sentence,
        "answer_B"=> $faker->sentence,
        "answer_C"=> $faker->sentence,
        "answer_D"=> $faker->sentence,
        "answer_true"=> chr(rand(65,68)),
    ];
});
