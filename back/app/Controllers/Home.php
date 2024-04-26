<?php

namespace App\Controllers;
use App\Models\Ordinateurs;
use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index(): string
    {
        $this->response->setContentType('application/json');
        $model = new Ordinateurs();
        $data = $model->findAll();
        return json_encode($data);
    }
}
