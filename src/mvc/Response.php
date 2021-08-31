<?php

namespace App\mvc;

/**
 * Class Response
 */
class Response
{
    public function statusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirectTo($url)
    {
        header("Location: $url");
    }
}