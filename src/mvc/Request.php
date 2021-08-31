<?php

namespace App\mvc;

/**
 * Class Request
 */
class Request
{
    const HTTP_GET = 'get';
    const HTTP_POST = 'post';

    public function method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function url()
    {
        $path = $_SERVER['REQUEST_URI'];
        $position = strpos($path, '?');

        if ($position !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    public function isHttpGet()
    {
        return $this->method() === self::HTTP_GET;
    }

    public function isHttpPost()
    {
        return $this->method() === self::HTTP_POST;
    }

    public function body()
    {
        $bodyData = [];
        if ($this->isHttpGet()) {
            foreach ($_GET as $key => $value) {
                $bodyData[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->isHttpPost()) {
            foreach ($_POST as $key => $value) {
                $bodyData[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $bodyData;
    }
}