<?php

use App\Lesson;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LessonsTest extends ApiTester
{
    use WithoutMiddleware; // bypasses Auth and other middleware
    use DatabaseTransactions; // rollbacks the transaction
    //use DatabaseMigrations; // reruns migrations // i couldn't make it work

    /** @test */
    public function it_fetches_lessons()
    {

        //arrange
        $this->times(5)->makeLesson();

        //act
        $this->getJson('api/v1/lessons');

        //assert
        $this->assertResponseOk();
    }

    /**
     * @param array $lessonFields
     */
    private function makeLesson($lessonFields = [])
    {
        while ($this->times--) {
            $lesson = array_merge([
                'title' => 'Test Title ' . $this->times . " " . $this->fake->sentence,
                'body' => 'Test Body ' . $this->times . " " . $this->fake->paragraph,
                'some_bool' => $this->fake->boolean
            ], $lessonFields);
            Lesson::create($lesson);
        }
    }


}
