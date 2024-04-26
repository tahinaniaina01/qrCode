<?php

namespace App\Models;

use CodeIgniter\Model;

class presencePcBDD extends Model
{
    protected $table = 'presence_pc_portable';
    protected $primarykey = 'id';
    protected $allowedFields = ['id_pc_etudiant','date_operation', 'status'];

}