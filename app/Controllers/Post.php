<?php
namespace App\Controllers;

use CodeIgniter\I18n\Time;

class Post extends BaseController
{
    public function index()
    {
        $data['errors'] = "";
        echo view('newThread', $data);
    }

    public function searchItem()
    {
        $searchTerm = $this->request->getVar('search');

        if (empty($searchTerm)) {
            return [];
        }

        $model = model('App\Models\Post_model');

        $results = $model->search($searchTerm);

        $response = json_encode($results);
        header('Content-Type: application/json');
        echo $response;
    }

    public function post_newThread()
    {
        $session = session();
        $name = $session->get('username');
        $pid = uniqid('', true);
        $category = $this->request->getPost('category');
        $title = $this->request->getPost('title');
        $content = $this->request->getPost('content');
        $lock = $this->request->getPost('lock');
        if (is_null($lock)) {
            $lock = 0;
        }
        $hit = 0;
        $thumbup = 0;
        $currentDateTime = date('Y-m-d H:i:s');

        $formattedDateTime = date('Y-m-d', strtotime($currentDateTime));
        $date = $formattedDateTime;

        $files = $_FILES['postfile'];
        $i = 0;

        $filenames = null;
        $fileCount = null;
        if (isset($files['name']) && is_array($files['name'])) {
            foreach ($files['name'] as $file_name) {
                if ($file_name === "") {
                    $model = model('App\Models\Post_model');
                    break;
                }
                $file_name_parts = explode('.', $file_name);
                $file_ext = strtolower(end($file_name_parts));
                $new_file_name = uniqid('', true) . '.' . $file_ext;
                move_uploaded_file($_FILES['postfile']['tmp_name'][$i], WRITEPATH . 'Post/' . $new_file_name);
                $i++;
                $filenames = $filenames . $new_file_name . ",";

                $model = model('App\Models\Post_model');
            }
        }
        $model->post($pid, $name, $title, $content, $filenames, $lock, $category, $thumbup, $date);
        Header("Location:/demo");

    }

    public function showPostbycategory($category)
    {
        $session = session();
        if ($session->has('username')) {
            $model = model('App\Models\Post_model');
            $model->getPostbycategory($category);
        } else {
            $data['error'] = "";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }

    public function showHotPost()
    {
        $session = session();
        if ($session->has('username')) {
            $model = model('App\Models\Post_model');
            $model->getHotTopicPost();
        } else {
            $data['error'] = "";
            echo view('template/header');
            echo view('login', $data);
            echo view('template/footer');
        }
    }
}