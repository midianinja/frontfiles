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
$factory->define(\Spatie\Permission\Models\Permission::class, function () {
    return [
        'name' => 'upload-file',
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Spatie\Permission\Models\Role::class, function () {
    return [
        'name' => 'user-basic',
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(FrontFiles\User::class, function (Faker\Generator $faker) {
    $name = $faker->name;
    return [
        'name'              => $name,
        'email'             => $faker->unique()->safeEmail,
        'password'          => 'secret',
        'allowed_space'     => 10737418240,
        'confirmed'         => true,
        'remember_token'    => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(FrontFiles\File::class, function (Faker\Generator $faker) {
    $short_id = FrontFiles\File::generateUniqueShortID(8);
    $extension = 'mp4';
    $name = $short_id . '.' . $extension;

    return [
        'user_id' => function() {
            return factory('FrontFiles\User')->create()->id;
        },
        'short_id'      => $short_id,
        'type'          => 'video',
        'extension'     => $extension,
        'size'          => 15000000,
        'original_name' => $faker->word,
        'name'          => $name,
        'url'           => 'http://techslides.com/demos/sample-videos/small.mp4',
        'title'         => $faker->sentence,
        'description'   => $faker->paragraph,
        'where'         => 'Odivelas, Lisbon, Portugal',
        'when'          => $faker->dateTimeThisMonth,
        'why'           => $faker->paragraph,
    ];
});