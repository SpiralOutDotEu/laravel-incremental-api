<?php
/**
 * Created by PhpStorm.
 * User: v-dev
 * Date: 25/3/2016
 * Time: 1:06 μμ
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Response;

/**
 * Class ApiController
 * @package App\Http\Controllers
 */
class ApiController extends Controller
{
    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not Found')
    {
        return $this->setStatusCode(404)->respondWithError('Lesson not found.');
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message)
    {
        return $this->respond([
            'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
            ]
        ]);
    }

    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message
        ]);
    }

    /**
     * @return mixed
     */
    public function respondParametersFailed($message)
    {
        return $this->setStatusCode(422)
            ->respondWithError($message);
    }

}