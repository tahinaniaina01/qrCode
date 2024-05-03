<?php
namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class SendMail extends BaseController{

    public function index()
    {
        return view('form_view');
    }
    function sendMail(){
        $to = $this->request->getVar('mailTo');
        $subject = $this->request->getVar('subject');
        $message = $this->request->getVar('message');
        $piece =  $this->request->getVar('salu');
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('mfock@mit-ua.mg','Confirm Registration');
        $email->setSubject($subject);
        $email->setMessage($message);
        if($email->send())
        {
            echo 'success';
        }
        else{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}