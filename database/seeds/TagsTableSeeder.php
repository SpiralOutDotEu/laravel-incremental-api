<?php
use App\Lesson;
use App\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;


/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 20/3/2016
 * Time: 10:22 μμ
 */
class TagsTableSeeder extends Seeder
{
    /**
     *
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 10) as $index) {
//           DB::table('lessons')->insert([
//                'title' => $faker->sentence(5),
//                'body' => $faker->paragraph(4)
//            ]);
            $tag = New Tag();
            $tag->name = $faker->word;
            $tag->save();
        }

    }

}