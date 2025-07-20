<?php

namespace App\Traits;

use App\Helpers\ResponseUtil;
use Illuminate\Support\Facades\Response;

trait ResponseTrait
{
    /**
     * Send response valid
     *
     * @param  mixed  $result
     * @param  string  $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message, int $code = 200)
    {
        if (! is_array($result) || (is_array($result) && ! isset($result['export']))) {
            return Response::json(ResponseUtil::makeResponse($message, $result), $code);
        }

        return $result['export'];
    }

    /**
     * Send response error
     *
     * @param  string  $error
     * @param  int  $code
     * @param  array  $additional
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $code = 404, $additional = [])
    {
        return Response::json(ResponseUtil::makeError($error, [], $additional), $code);
    }

    /**
     * Untuk validasi yang tidak disimpan di FormRequest (custom validation).
     */
    public function sendBadRequest($result, $message, int $code = 400)
    {
        return Response::json(ResponseUtil::makeInvalid($message, $result), $code);
    }
}
