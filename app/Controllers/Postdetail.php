<?php
namespace App\Controllers;

class Postdetail extends BaseController
{
	public function index()
	{
		$model = model('App\Models\Post_model');
		$db = \Config\Database::connect();
		$query = $db->table('Post');
		$query = $db->query('SELECT * FROM Post');
		$result = $query->getResult();

		echo view('postdetail', $result);
	}

	public function detail($pid)
	{
		$session = session();
		if ($session->has('username')) {
			$model = model('App\Models\Post_model');
			$data['postdetail'] = $model->find($pid);
			$db = \Config\Database::connect();
			$files = $db->table('Post')->where('pid', $pid)->get()->getResultArray();
			$data['postfile'] = $files;
			echo view('postdetail', $data);
		} else {
			$data['error'] = "";
			echo view('template/header');
			echo view('login', $data);
			echo view('template/footer');
		}
	}

	public function favourite()
	{
		$session = session();
		$username = $session->get('username');
		$model = model('App\Models\Favourite_model');
		$pid = $_POST['hidden_pid'];
		$favourite = $model->where(['pid' => $pid, 'username' => $username])->first();
		if (empty($favourite)) {
			$model->favoriteInsert($username, $pid);
		} else {
			$model->favoriteDelete($username, $pid);
		}
		Header("Location:/demo/postdetail/" . $pid);
	}

	public function like()
	{
		$model = model('App\Models\Post_model');
		$pid = $_POST['hidden_pid'];
		$model->like($pid);
		Header("Location:/demo/postdetail/" . $pid);
	}

}