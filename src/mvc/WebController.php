<?php

namespace App\mvc;

/**
 * Class WebController
 */
class WebController
{
    public string $action = '';

    public function render($view, $params = []): string
    {
        return App::$app->router->renderView($view, $params);
    }

    public function flash($type, $message)
    {
        App::$app->session->setFlash($type, $message);
    }
}