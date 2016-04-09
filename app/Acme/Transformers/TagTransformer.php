<?php
/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 24/3/2016
 * Time: 7:52 πμ
 */

namespace App\Acme\Transformers;


class TagTransformer extends Transformer
{

    public function transform($tag)
    {
        return [
            'name' => $tag['name']
        ];
    }
}