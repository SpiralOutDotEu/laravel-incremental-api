<?php
use App\Lesson;
use App\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 20/3/2016
 * Time: 10:22 μμ
 */
class LessonsTagTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        $faker = Faker::create();
        $lessonIds = DB::table('lessons')->pluck('id');
        $tagIds = DB::table('tags')->pluck('id');

        foreach (range(1, 10) as $index) {
            DB::table('lessons_tag')->insert([
                'lesson_id' => $faker->randomElement($lessonIds),
                'tag_id' => $faker->randomElement($tagIds),
            ]);

        }

    }

}