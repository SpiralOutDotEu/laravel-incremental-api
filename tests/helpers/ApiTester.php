<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;
use App\Lesson;
use App\Tag;

/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 8/4/2016
 * Time: 3:52 μμ
 */
abstract class ApiTester extends TestCase
{
    protected $fake;


    /**
     * ApiTester constructor.
     * @param $faker
     */
    function __construct()
    {
        $this->fake = Faker::create();
    }

    /**
     *
     */
    function setUp()
    {

        parent::setUp();
        // I'm not using it , because i prefer 'uses DatabaseTransaction'
        // but you can call
        // $this->app['artisan']->call('migrate');
        // or
        Artisan::call('migrate');
    }


    /**
     * @param $lesson
     */
    public function assertObjectHasAttributes()
    {
        $args = func_get_args();
        $object = array_shift($args);

        foreach ($args as $attribute) {
            $this->assertObjectHasAttribute($attribute, $object);
        }


    }

    protected function getJson($uri, $method = 'GET', $parameteres = [])
    {
        return json_decode($this->call($method, $uri, $parameteres)->getContent());
    }


}