<?php

use App\Lesson;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LessonsTest extends ApiTester
{
    use Factory;
    use WithoutMiddleware; // bypasses Auth and other middleware
    use DatabaseTransactions; // rollbacks the transaction
    //use DatabaseMigrations; // reruns migrations // i couldn't make it work

    /** @test */
    public function it_fetches_lessons()
    {

        //arrange
        $this->times(5)->make('Lesson');

        //act
        $this->getJson('api/v1/lessons');

        //assert
        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_lesson()
    {

        //arrange
        $this->make('Lesson');

        //act
        $lesson = $this->getJson('api/v1/lessons/1')->data;

        //assert
        $this->assertResponseOk();
        // $this->assertObjectHasAttribute('title',$lesson);
        $this->assertObjectHasAttributes($lesson, 'title', 'body', 'active');
    }

    /** @test */
    public function it_creates_a_new_lesson_given_valid_parameteres()
    {
        $this->getJson('api/v1/lessons', 'POST', $this->getStub());

        $this->assertResponseStatus(201);
    }

    public function getStub()
    {
        return [
            'title' => 'Test Title ' . $this->times . " " . $this->fake->sentence,
            'body' => 'Test Body ' . $this->times . " " . $this->fake->paragraph,
            'some_bool' => $this->fake->boolean
        ];
    }

    /** @test */
    public function it_throws_a_422_if_a_new_lesson_request_fails_validation()
    {
        $this->getJson('api/v1/lessons', 'POST');
        $this->assertResponseStatus(422);
    }

    /** @test */
    public function it_404s_if_a_lesson_is_not_found()
    {
        $json = $this->getJson('api/v1/lessons/x');
        $this->assertResponseStatus(404);
        $this->assertObjectHasAttributes($json, 'error');

    }


}
