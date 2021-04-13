<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    
    // get two random, unique users
    $author = User::all()->random();
    $recipient = User::all()->except([$author->id])->random();

    return [
        'author_id' => $author->id,
        'recipient_id' => $recipient->id,
        'content' => $faker->sentence(3),
    ];
});
