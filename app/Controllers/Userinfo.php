<?php

namespace App\Controllers;

use App\Models\User_model;
use PHPUnit\Framework\Constraint\IsEmpty;


class Userinfo extends BaseController
{
    public function index()
    {
        $data['error'] = "";
        // check whether the cookie is set or not, if set redirect to welcome page, if not set, check the session
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            echo view("userinfo");

        } else {
            $session = session();
            $username = $session->get('username');
            $password = $session->get('password');
            if ($username && $password) {
                echo view("userinfo");
            } else {
                echo view('template/header');
                echo view('login', $data);
                echo view('template/footer');
            }
        }
    }
    public function edit()
    {
        $session = session();
        if ($session->has('username')) {
            echo view("edituserinfo");
        } else {
            $data['error'] = "";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function showfavlist()
    {
        $session = session();
        if ($session->has('username')) {
            $username = $session->get('username');
            $model = model('App\Models\Favourite_model');
            $model->showfav($username);
        } else {
            $data['error'] = "";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }

    }

    public function saveChanges()
    {
        $profile_img = $this->request->getFile('profile-image');
        if ($profile_img->isValid()) {
            $file_name_parts = explode('.', $profile_img->getName());
            $file_ext = strtolower(end($file_name_parts));
            $new_file_name = uniqid('', true) . '.' . $file_ext;
            move_uploaded_file($profile_img, WRITEPATH . 'users/' . $new_file_name);

            $image_path = WRITEPATH . 'users/' . $new_file_name;
            $imagick = \Config\Services::image();
            $imagick->withFile($image_path)
                ->resize(200, 0, true)
                ->save($image_path, 80);
                $profile = $new_file_name;
        } else {
            $profile = null;
        }

        $phonenumber = $this->request->getPost('phone');
        $name = $this->request->getPost('name');
        $model = model('App\Models\User_model');
        $model->saveUserinfo($phonenumber, $name, $profile);
    }
}