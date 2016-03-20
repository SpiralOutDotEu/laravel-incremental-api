<?php
use Faker\Factory as Faker;

/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 20/3/2016
 * Time: 10:22 μμ
 */
class LessonsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,30)as $index)
        {
            Lesson::create([
                'title' => $faker->sentence(5),
                'body' => $faker->paragraph(4)
            ]);
        }

    }

}