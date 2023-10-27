<?php

namespace App\Models;

use CodeIgniter\Model;

class Post extends Model
{
    protected $table = 'Post';
    protected $primaryKey = 'pid';
    protected $allowedFields = ['pid', 'title', 'content', 'thumbup'];

    public function post($pid, $name, $title, $content, $file, $lock, $category, $thumbup, $date)
    {

        $post = [
            'pid' => $pid,
            'name' => $name,
            'title' => $title,
            'content' => $content,
            'file' => $file,
            'lock' => $lock,
            'category' => $category,
            'thumbup' => $thumbup,
            'date' => $date
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('Post');
        if ($builder->insert($post)) {
            return true;
        } else {
            return false;
        }
    }

    public function search($searchTerm) {
        $db = \Config\Database::connect();

        $query = $db->table('Post')
                    ->like('title', '%' . $searchTerm . '%')
                    ->get();
        
        $results = $query->getResultArray();
        return $results;
    }

    public function like($pid)
    {
        $db = \Config\Database::connect();
        $post = $db->table('Post')->where('pid', $pid)->get()->getResultArray();
        $thumbup = $post[0]['thumbup'] + 1;
        $data = [
            'thumbup' => $thumbup,
        ];
        $db->table('Post')->where('pid', $pid)->update($data);
    }

    public function getPostbycategory($category)
    {
        $db = \Config\Database::connect();
        $post['postResult'] = $db->table('Post')->where('category', $category)->get()->getResultArray();
        $post['category'] = $category;
        echo view('categoryPost', $post);
    }

    public function getHotTopicPost()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Post');
        $builder->select()
            ->orderBy('thumbup', 'DESC')
            ->limit(5)
            ->where('thumbup > 0');
        $post['post'] = $builder->get()->getResultArray();
        echo view('home', $post);
    }
}