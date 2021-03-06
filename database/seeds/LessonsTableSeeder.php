<?php
use App\Lesson;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 20/3/2016
 * Time: 10:22 μμ
 */
class LessonsTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,30)as $index)
        {
//           DB::table('lessons')->insert([
//                'title' => $faker->sentence(5),
//                'body' => $faker->paragraph(4)
//            ]);
            $lesson = new Lesson;
            $lesson->title = $faker->sentence(5);
            $lesson->body = $faker->paragraph(4);
            $lesson->some_bool = $faker->boolean();
            $lesson->save();
        }

    }

}