<?php

namespace App\Helpers;

class ResponseUtil
{
    /**
     * @param  string  $message
     * @param  mixed  $data
     * @return array
     */
    public static function makeResponse($message, $data)
    {
        $return = [
            'success' => true,
            'data' => $data,
            'message' => $message,
        ];

        return $return;
    }

    /**
     * @param  string  $message
     * @return array
     */
    public static function makeError($message, array $data = [], array $additional = [])
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if (! empty($additional)) {
            $res['info'] = $additional;
        }

        if (! empty($data)) {
            $res['data'] = $data;
        }

        return $res;
    }

    /**
     * @param  string  $message
     * @param  mixed  $data
     * @return array
     */
    public static function makeInvalid($message, $data)
    {
        $return = [
            'success' => false,
            'data' => $data,
            'message' => $message,
        ];

        return $return;
    }
}
