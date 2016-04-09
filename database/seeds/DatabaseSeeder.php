<?php


use App\Lesson;

use App\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * @var array
     */
    private $tables = [
        'lessons',
        'tags',
        'lesson_tag'

    ];
    /**
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->cleanDatabase();

        $this->call(LessonsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(LessonsTagTableSeeder::class);

        Model::reguard();

    }

    public function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Lesson::truncate();
        Tag::truncate();
        foreach ($this->tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
