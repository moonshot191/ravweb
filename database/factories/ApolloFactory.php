<?php
use Faker\Generator as Faker;
$factory->define(App\Apollo::class, function (Faker $faker) {
    return [
        'member_id' => $faker->randomNumber($nbDigits = NULL, $strict = false),
        'username' => $faker->userName(),
        'question'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'answer'=>$faker->sentence($nbWords = 6, $variableNbWords = true),
        'user_id' => function() {
            return \App\User::inRandomOrder()->first()->id;
        }
    ];
});
