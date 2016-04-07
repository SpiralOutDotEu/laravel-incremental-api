<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\Tag;
use App\Acme\Transformers\TagTransformer;
use Illuminate\Http\Request;

use App\Http\Requests;

class TagsController extends ApiController
{
    protected $tagTransformer;

    /**
     * TagsController constructor.
     * @param $tagTransformer
     */
    public function __construct(TagTransformer $tagTransformer)
    {
        $this->tagTransformer = $tagTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @param null $lessonId
     * @return \Illuminate\Http\Response
     */
    public function index($lessonId = null)
    {
        $tags = $this->getTags($lessonId);
        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all())
        ]);

    }



    /**
     * @param $lessonId
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getTags($lessonId)
    {
        $tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();
        return $tags; // all is bad!!!
    }
}
