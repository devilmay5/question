<?php

use Faker\Generator as Faker;

$factory->define(\App\QuestionTitle::class, function (Faker $faker) {
    return [
        //
        "category_id" => 0,
        "name" => "测试".$faker->name."套题",
    ];
});
