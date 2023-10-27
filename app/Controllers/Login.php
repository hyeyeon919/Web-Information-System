<?php

namespace App\Controllers;

use PHPUnit\Framework\Constraint\IsTrue;

class Login extends BaseController
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
                echo view("hotTopic");
            } else {
                echo view('template/header');
                echo view('login', $data);
                echo view('template/footer');
            }
        }
    }

    public function check_login()
    {
        $data['error'] = "<div class=\"alert alert-danger\" role=\"alert\"> Incorrect input or Need verification !! </div> ";
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $model = model('App\Models\User_model');
        $check = $model->login($username, $password);
        $if_remember = $this->request->getPost('remember');
        if ($check) {
            # Create a session 
            $session = session();
            $session->set('username', $username);
            $session->set('password', $password);

            if ($if_remember) {
                # Create a cookie
                setcookie('username', $username, time() + (86400 * 30), "/");
                setcookie('password', $password, time() + (86400 * 30), "/");
            } else {
                # Delete the cookie
                setcookie('username', '', time() - 3600, "/");
                setcookie('password', '', time() - 3600, "/");
            }
            echo view('hotTopic');
        } else {
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function logout()
    {
        $data['error'] = "";
        helper('cookie');
        $session = session();
        $session->destroy();
        //destroy the cookie
        setcookie('username', '', time() - 3600, "/");
        setcookie('password', '', time() - 3600, "/");


        return redirect()->to(base_url('login'));
    }

    public function forgotPassword()
    {
        echo view('resetPassword');
    }

    public function forgotPW()
    {
        $model = model('App\Models\User_model');
        $email = $this->request->getPost('email');
        $model->forgotPassword($email);

    }

    public function newPassword($token)
    {
        $model = model('App\Models\User_model');
        $model->setnewPassword($token);
    }

    // password update
    public function updatePassword()
    {
        $model = model('App\Models\User_model');
        $password = $this->request->getPost('password');
        $email = $this->request->getPost('hidden_email');
        $token = $this->request->getPost('hidden_token');
        
        $check = $this->checkPasswordStrength($password);
        $data['email'] = $email;
        $data['password'] = $password;
        $data['token'] = $token;
        if ($check) {
            $model->updatePassword($email, $password);
        } else {
            echo '<script>window.location.href = "' . base_url() . 'reset/' . $token . '";</script>';

        }
    }

    public function checkPasswordStrength($password)
    {
        if (strlen($password) < 8) {
            echo "<script>alert('Password should be at least 8 letters! ');</script>";
            return false;
        }

        if (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {            
            echo "<script>alert('Password should be combination of lowercases, uppercases, numbers, special symbols!');</script>";
            return false;
        }

        else {
            return true;
        }
    }
}