<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;

class Emailsend extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('email_form');
    }

    public function send()
    {
        helper(['form']);

        $receiver = $this->request->getVar('receiver');
        $sender = $this -> request ->getVar('sender');
        $subject = $this -> request ->getVar('subject');
        $message = $this->request-> getVar('message');

        $email = new Email();

        $emailConf = [
            'protocol' => 'smtp',
            'wordWrap' => true,
            'SMTHost' => 'mailhub.eait.uq.edu.au',
            'SMTPPort' => 25
        ];
        $email->initialize($emailConf);
        $email->setTo($receiver);
        $email->setSubject($subject);
        $email->setMessage($message);
    } 
}
