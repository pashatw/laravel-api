<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    static function failResponse(string $message, $payload = [], int $code)
    {
        return response()->json(['code' => $code, 'message' => $message, 'payload' => $payload], $code);
    }

    static function successResponse(string $message, $payload = [], int $code = 200)
    {
        return response()->json(['code' => $code, 'message' => $message, 'payload' => $payload], $code);
    }
}
