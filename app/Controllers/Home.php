<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('hotTopic');
    }
    public function newThread()
    {
        $session = session();
        if ($session->has('username')) {
            echo view('newThread');
        } else {
            $data['error'] = "";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }
}