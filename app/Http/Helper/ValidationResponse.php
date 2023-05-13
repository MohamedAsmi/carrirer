<?php

namespace App\Http\Helper;

trait ValidationResponse
{
    protected static function _response($result, $message, $errors = [], $status = 200, $options = [])
    {
        return response()->json(['result' => $result, 'message' => $message, 'errors' => $errors, 'options' => $options], $status);
    }
}
