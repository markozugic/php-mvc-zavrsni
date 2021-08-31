<?php

namespace App\controllers;

use App\mvc\WebController;

class AboutController extends WebController 
{

    public function index()
    {
        return $this->render('about');
    }

}