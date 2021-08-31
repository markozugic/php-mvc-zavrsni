<?php

namespace App\Controllers;

use App\mvc\Request;
use App\mvc\Response;
use App\mvc\mailer\Mailer;
use App\mvc\WebController;

class ContactController extends WebController
{
    public function index()
    {
        return $this->render('contact');
    }

    public function send(Request $request, Response $response)
    {
        $data = $request->body();

        $mailer = new Mailer();

        $mailer->send($data['name'], $data['email'], $data['message']);

        $this->flash('success', 'Thank you for contacting me, I will try to reply as soon as possible.');

        $response->redirectTo('/');
    }
}