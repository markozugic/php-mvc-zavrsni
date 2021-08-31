<?php

namespace App\mvc;

/**
 * Class View
 */
class View
{
    public string $title = '';

    public function renderView($view, array $params)
    {
        $viewContent = $this->renderOnlyView($view, $params);
        ob_start();
        include_once App::$ROOT_DIR."/views/layout.php";
        $layoutContent = ob_get_clean();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    public function renderOnlyView($view, array $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once App::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}