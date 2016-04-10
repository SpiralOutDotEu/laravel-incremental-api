<?php

/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 10/4/2016
 * Time: 4:42 μμ
 */
trait Factory
{
    protected $times = 1;

    /**
     * @param $count
     */
    protected function times($count)
    {
        $this->times = $count;
        return $this;
    }

    protected function make($type, array $fields = [])
    {
        while ($this->times--) {
            $stub = array_merge($this->getStub(), $fields);
            $class = "App\\" . $type; // it is required to include the path
            $class::create($stub);
        }
    }

    public function getStub()
    {
        throw new BadMethodCallException('Create your own getStub method to declare your fields');
    }

}