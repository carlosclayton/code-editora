<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\CodeEduUser\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'verified' => true
    ];
});


$factory->define(CodeEduBook\Models\Category::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});


$factory->define(CodeEduBook\Models\Book::class, function (Faker\Generator $faker) {
    static $password;


    $repository = app(CodeEduUser\Repositories\UserRepository::class);
    $id = $repository->all()->random()->id;
    return [
        'title' => $faker->title,
        'subtitle' => $faker->word,
        'price' => $faker->numberBetween(50, 100),
        'author_id' =>$id
    ];
});
