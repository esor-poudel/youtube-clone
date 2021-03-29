<?php

use Faker\Generator as Faker;
use laratube\Channel;
use laratube\User;

$factory->define(Channel::class, function (Faker $faker) {
    return [
        'name'=>$faker->sentence(3),
        'user_id'=> function()
        {
            return factory(User::class)->create()->id;
        },
        'description'=> $faker->sentence(10),
    ];
});
