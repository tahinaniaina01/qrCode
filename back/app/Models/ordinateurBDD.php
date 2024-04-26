<?php

namespace App\Models;

use CodeIgniter\Model;

class ordinateurBDD extends Model
{
    protected $table = 'ordinateur';
    protected $primarykey = 'id';
    protected $allowedFields = ['type_ordinateur'];

}