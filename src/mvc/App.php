<?php

namespace App\mvc;

/**
 * Class App
 */
class App
{
    public static App $app;
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public ?WebController $controller = null;
    public Session $session;
    public View $view;


    public function __construct($rootDirectory)
    {
        self::$ROOT_DIR = $rootDirectory;
        self::$app = $this;

        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();
        $this->session = new Session();
    }

    public function run()
    {
        try {
            echo $this->router->resolveRoute();
        } catch(\Exception $e) {
            echo $this->router->renderView('error', [
                'exception' => $e,
            ]);
        }
    }

}