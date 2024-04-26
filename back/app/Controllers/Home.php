<?php

namespace App\Controllers;
use App\Models\Inscription;
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index(): string
    {
        $this->response->setContentType('application/json');
        $model = new Inscription();
        $data = $model->findAll();
        return json_encode($data);
    }
}
