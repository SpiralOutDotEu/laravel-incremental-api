<?php namespace App\Acme\Transformers;

/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 24/3/2016
 * Time: 7:46 πμ
 */
abstract class Transformer
{
    public function transformCollection(array $items)
    {
        return array_map([$this, 'transform'], $items);
    }

    public abstract function transform($item);
}