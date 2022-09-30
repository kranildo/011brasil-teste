<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\JsonResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function retornoJson(
        int $status = 200,
        string $message = null,
        array $data = [],
        array $errors = []
    ): JsonResponse {
        return new JsonResponse([
            "status" => $status,
            "message" => $message,
            "data" => $data,
            "errors" => $errors,
        ], $status);
    }
}