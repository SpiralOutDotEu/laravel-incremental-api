<?php

namespace App\Http\Controllers;

use App\Acme\Transformers\LessonTransformer;
use App\Lesson;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\URL;


class LessonsController extends ApiController
{

    protected $lessonTransformer;

    /**
     * LessonsController constructor.
     * @param $lessonTransformer
     */
    public function __construct(LessonTransformer $lessonTransformer)
    {
        $this->lessonTransformer = $lessonTransformer;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = Input::get('limit') ?: 3;
        $limit = ($limit <= 20) ? $limit : 20;
        $lessons = Lesson::orderBy('title', 'asc');
        /*  i can just do this:
         *    return $lessons-paginate($limit);
         *  but it will not be transformed
        */
        $lessons = $lessons->paginate($limit);
        $lessons->setPath(URL::to('/') . '/api/v1/lessons/?limit=' . $limit);
        //$lessons = Lesson::all(); // Really bad practice

        return $this->respond([
            'data' => $this->lessonTransformer->transformCollection($lessons->all()),
            'paginator' => [
                'total_count' => $lessons->total(),
                'total_pages' => $lessons->lastPage(),
                'previous_page' => $lessons->previousPageUrl(),
                'current_page' => $lessons->currentPage(),
                'next_page' => $lessons->nextPageUrl(),
                'limit' => $lessons->perPage(),
                'links' => $lessons->links(),
            ],

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Input::get('title') or !Input::get('body')) {
            return $this->respondParametersFailed('Title or Body missing');
        }
        Lesson::create($request->all());
        return $this->respondCreated('Lesson successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);
        if ( ! $lesson)
        {
            return $this->respondNotFound('Lesson does not exist.');
        }
        return $this->respond([
            'data' => $this->lessonTransformer->transform($lesson)
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
