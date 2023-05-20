<?php

namespace App\Http\Controllers;

use App\Http\Helper\ResponseHelper;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use ResponseHelper;

    protected function response($result, $message, $errors = [], $status = 200, $options = [])
    {
        return $this->_response($result, $message, $errors, $status, $options);
    }

    protected static function redirectWithResultAndMessage($route, $result, $message, $messageFor = '', $withInput = false)
    {
        $result = ($result == 'error') ? 'danger' : $result;
        return self::redirectWithMessages($route, [
            'result' => $result,
            'message' => $message,
            'message_for' => $messageFor
        ], $withInput);
    }

    protected static function redirectWithMessages($route, $messages = [], $withInput = false)
    {
        
      
    }
}
