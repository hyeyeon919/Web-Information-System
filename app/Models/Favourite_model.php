<?php

namespace App\Models;

use CodeIgniter\Model;


class Comment extends Model
{
    protected $table = 'Favourite';
    protected $primaryKey = ['pid', 'username'];
    protected $allowedFields = ['username', 'pid'];

    public function favoriteInsert($username, $pid)
    {

        $favorite = [
            'username' => $username,
            'pid' => $pid,
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('Favourite');
        if ($builder->insert($favorite)) {
            return true;
        } else {
            return false;
        }
    }

    public function favoriteDelete($username, $pid)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Favourite');
        $builder->where('username', $username);
        $builder->where('pid', $pid);
        $builder->delete();
    }

    public function showfav($username)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Favourite');
        $builder->select('pid');
        $builder->where('username', $username);
        $results = $builder->get()->getResult();
        $count = count($results);
        $pid_array = array();
        if ($count == 0) {
            $results['results'] = $pid_array;
            echo view('favlist', $results);
        } else {
            foreach ($results as $row) {
                $pid_array[] = $row->pid;
            } 
            $post_query = $db->table('Post')
                ->whereIn('pid', $pid_array)
                ->get();
            $results['results'] = $post_query->getResultArray();
            echo view('favlist', $results);
        }
    }
}