<?php
/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 24/3/2016
 * Time: 7:52 πμ
 */

namespace App\Acme\Transformers;


class LessonTransformer extends Transformer
{

    public function transform($lesson)
    {
        return [
            'title' => $lesson['title'],
            'body' => $lesson['body'],
            'active' => (boolean) $lesson['some_bool']
        ];
    }
}