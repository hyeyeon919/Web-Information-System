<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 인증되지 않은 사용자는 로그인 페이지로 이동
        if (!session()->has('username')) {
            // return redirect()->to(base_url('login'));

            // 로그인 화면으로 direct
        }
        else {
            // return redirect()->to(base_url('HotTopic'));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // 필터 후처리 코드 작성
    }
}