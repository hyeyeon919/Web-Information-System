<?php
namespace App\Controllers;

class HotTopic extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->has('username')) {
            echo view('hotTopic');
        } else {
            $data['error'] = "";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function load()
    {
        $model = model('App\Models\Post_model');
        $posts = $model->findAll();
        $data['posts'] = $posts;
        echo view('hotTopic', $data);
    }
}