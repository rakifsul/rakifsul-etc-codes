<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class BaseApiController extends ResourceController
{
    protected $format = 'json';

    protected function respondSuccess($data, int $status = 200)
    {
        return $this->respond([
            'status' => 'success',
            'data'   => $data,
        ], $status);
    }

    protected function respondError(string $message, int $status = 400, array $context = [])
    {
        return $this->respond([
            'status'  => 'error',
            'message' => $message,
            'context' => $context,
        ], $status);
    }
}
