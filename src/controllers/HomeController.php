<?php

namespace App\Controllers;

use App\mvc\WebController;

class HomeController extends WebController
{
    public function index()
    {
        $viewModel = ['name' => 'Marko Žugić software developer'];

        return $this->render('home', $viewModel);
    }
}