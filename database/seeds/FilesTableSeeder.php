<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use FrontFiles\File;

class FilesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $faker = Faker::create();

        foreach (range(1,30) as $x)
            File::create([
                'user_id' => $faker->numberBetween(1, 5),
                'short_id' => $faker->randomNumber(8),
                'type' => '',
                'extension' => '',
                'original_name' => '',
                'name' => '',
                'url' => $faker->url,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'where' => $x > 5 ? $faker->city : 'Lisbon',
                'when' => $faker->dateTimeThisMonth,
            ]);
        */
    }
}
