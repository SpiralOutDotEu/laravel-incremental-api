<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\Artisan;

/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 8/4/2016
 * Time: 3:52 μμ
 */
class ApiTester extends TestCase
{
    protected $fake;
    protected $times = 1;

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

    /**
     * @param $count
     */
    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }

    protected function getJson($uri)
    {
        return json_decode($this->call('GET', $uri)->getContent());
    }


}