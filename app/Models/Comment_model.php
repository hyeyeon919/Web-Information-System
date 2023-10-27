<?php

namespace App\Models;

use CodeIgniter\Model;



class Comment extends Model
{
    protected $table = 'Comment'; 
    protected $primaryKey = 'cid';
    protected $allowedFields = ['username', 'content'];

    public function comment($cid, $username, $pid, $date, $content)
    {

        $comment = [
            'cid' => $cid,
            'username' => $username,
            'pid' => $pid,
            'content' => $content,
            'date' => $date
        ];

        $db = \Config\Database::connect();
        $builder = $db->table('Comment');
        if ($builder->insert($comment)) {
            return true;
        } else {
            return false;
        }
    }
}