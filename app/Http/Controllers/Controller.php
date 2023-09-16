<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function sendResponse($result, $message)
    {
        $response = [
            'status' => true,
            'message' => $message,
            'result' => $result
        ];

        return response()->json($response, 200);
    }

    public function sendError($errorMessage, $error = [], $code = 404)
    {
        $response = [
            "status" => false,
            "message" => $errorMessage,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $error;
        }

        return response()->json($response, $code);
    }
}
