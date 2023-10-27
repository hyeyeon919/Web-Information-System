<?php

namespace App\Controllers;

class Newuser extends BaseController
{
    public function index()
    {
        $data['error'] = "";
        // check whether the cookie is set or not, if set redirect to welcome page, if not set, check the session
        if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
            echo view("hotTopic");

        } else {
            $session = session();
            $username = $session->get('username');
            $password = $session->get('password');
            if ($username && $password) {
                echo view("userinfo", $data);
            } else {
                echo view("newUser", $data);
            }
        }
    }
    public function signup()
    {

        session_start();

        $captcha = $_POST['g-recaptcha-response'];
        $secretKey = '6LekaAcmAAAAAEmC7UqmHvMI02D1gM1XS3cKSDc1';
        $ip = $_SERVER['REMOTE_ADDR'];

        $data = array(
            'secret' => $secretKey,
            'response' => $captcha,
            'remoteip' => $ip
        );

        $url = "https://www.google.com/recaptcha/api/siteverify";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);

        $responseKeys = json_decode($response, true);

        if ($responseKeys["success"]) {
            $data['error'] = "";
            $name = $this->request->getPost('name');
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $phonenumber = $this->request->getPost('phonenumber');
            $email = $this->request->getPost('email');

            $model = model('App\Models\User_model');
            if ($this->checkPasswordStrength($password)) {
                $model->signin($name, $username, $password, $email, $phonenumber);

            } else {
                echo view("login", $data);
            }
        } else {
            echo view("newUser", $data);
        }


    }

    public function checkPasswordStrength($password)
    {
        if (strlen($password) < 8) {
            echo "<script>alert('Password should be at least 8 letters!');</script>";
            return false;
        }

        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
            echo "<script>alert('Password needs to include at least one lowercases, uppercases, numbers, special symbols!');</script>";
            return false;
        }
        else {
            return true;
        }
    }
}