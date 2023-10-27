<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Email\Email;

class User_model extends Model
{
    protected $table = 'users';

    protected $allowedFields = ['name', 'email', 'phonenumber', 'profile', 'password'];
    public function login($username, $password)
    {
        # ci4 how to use
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('username', $username);
        $builder->where('isverified', 1);
        $query = $builder->get();

        $user = $query->getRowArray();
        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }
    public function forgotPassword($email)
    {
        $token = bin2hex(random_bytes(16));
        $data['error'] = "";
        $db = \Config\Database::connect();

        $query = $db->table('users')
            ->where('email', $email)
            ->get();
        $emailcount = count($query->getResult());
        if ($emailcount == 1) {
            $this->sendresetPWEmail($email, $token);
        } else {
            echo "<script>alert('There is no user with $email ');</script>";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function signin($name, $username, $password, $email, $phonenumber)
    {
        $token = bin2hex(random_bytes(16));
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'name' => $name,
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'phonenumber' => $phonenumber,
            'token' => $token
        ];
        $data['error'] = "";
        $db = \Config\Database::connect();
        $query = $db->table('users')
            ->where('username', $username)
            ->get();
        $usernamecount = count($query->getResult());

        $query = $db->table('users')
            ->where('email', $email)
            ->get();
        $emailcount = count($query->getResult());

        if (($usernamecount > 0)) {
            echo "<script>alert('$username is already being used !');</script>";
            echo view('newUser');
        } else if (($emailcount > 0)) {
            echo "<script>alert('You have already signed in using $email !');</script>";
            echo view('newUser');
        } else {
            $builder = $db->table('users');
            if ($builder->insert($user)) {
                $this->sendVerificationEmail($email, $token);
                echo "<script>alert('Verification email has been sent to $email. Please verify your account to login.');</script>";
                echo view('newUser');

            }
        }
    }

    public function sendresetPWEmail($receiver, $token)
    {
        $email = new Email();

        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];

        $email->initialize($emailConf);
        $email->setFrom('infs3202-2ea5f4d0@uqcloud.net', 'Hyeyeon Lee');
        $email->setTo($receiver);
        $email->setSubject('reset Password');
        $email->setMessage('Please click on this link to reset your password: ' . base_url() . 'reset/' . $token);
        $email->send();

        echo "<script>alert('Link to reset your password has been sent $receiver');</script>";

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('email')->where('email', $receiver);
        $data = ['password' => $token];
        $builder->select('email')->where('email', $receiver)->update($data);

        $data['error'] = "";
        echo view('template/header');
        echo view('login', $data);
        echo view('template/footer');
    }

    public function saveUserinfo($phonenumber, $name, $profile)
    {
        $db = \Config\Database::connect();
        $session = session();
        $username = $session->get('username');
        $data = [
            'phonenumber' => $phonenumber,
            'name' => $name,
            'profile' => $profile
        ];
        $db->table('users')
            ->set($data)
            ->where('username', $username)
            ->update();
        Header("Location:/demo/userinfo");
    }

    public function checkEmail($email)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->where('email', $email)->get();
        if ($builder->countAll() == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function emailverification($token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('email');
        $builder->where('token', $token);
        $query = $builder->get();
        $result = $query->getRow();

        if (!$result) {
            return 'Invalid token';
        }

        $email = $result->email;
        $data = ['isverified' => 1];
        $builder->where('email', $email);
        $builder->update($data);
        $data['error'] = "";

        echo "<script>alert('$email is successfully verified !');</script>";
        echo view('template/header');
        echo view('login', $data);
        echo view('template/footer');
    }

    public function setnewPassword($token)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $result = $builder->where('password', $token);
        $result = $result->get()->getRow();
        $data['email'] = $result->email;
        $data['token'] = $token;
        echo view('newPassword', $data);
    }
    public function updatePassword($email, $password)
    {
        $db = \Config\Database::connect();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'password' => $password,
        ];
        $db->table('users')
            ->set($user)
            ->where('email', $email)
            ->update();
        echo "<script>alert('Your password has been successfully changed!');</script>";

        $data['error'] = "";
        echo view('template/header');
        echo view('login', $data);
        echo view('template/footer');
    }
    public function sendVerificationEmail($receiver, $token)
    {
        $email = new Email();

        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTPHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];
        $email->initialize($emailConf);
        $email->setFrom('infs3202-2ea5f4d0@uqcloud.net', 'Hyeyeon Lee');
        $email->setTo($receiver);
        $email->setSubject('Email Verification');
        $email->setMessage('Please click on this link to verify your email: ' . base_url() . 'verification/' . $token);
        $email->send();
    }
}