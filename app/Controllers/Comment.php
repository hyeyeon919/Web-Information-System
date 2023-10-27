<?php
namespace App\Controllers;

use CodeIgniter\CLI\Console;
use CodeIgniter\I18n\Time;


class Comment extends BaseController
{
    public function newComment()
    {
        $cid = uniqid('', true);
        $session = session();
        $username = $session->get('username');
        $content = $this->request->getPost('content');
        $currentDateTime = date('Y-m-d H:i:s');
        $date = date('Y-m-d', strtotime($currentDateTime));
        $model = model('App\Models\Comment_model');
        $pid = $_POST['hidden_pid'];
        $model->comment($cid, $username, $pid, $date, $content);
        Header("Location:/demo/postdetail/" . $pid); 
    }
}