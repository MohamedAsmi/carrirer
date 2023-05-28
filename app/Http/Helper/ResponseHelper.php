<?php

namespace App\Http\Helper;

trait ResponseHelper
{
    protected static function response($result, $message, $errors = [],  $status = 200, $data = [], $options = [])
    {
        return response()->json(['result' => $result, 'message' => $message, 'errors' => $errors, 'data' => $data, 'options' => $options], $status);
    }
}
