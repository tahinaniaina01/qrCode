<?php

namespace App\Models;

use CodeIgniter\Model;

class parcoursBDD extends Model
{
    protected $table = 'parcours';
    protected $primarykey = 'id';
    protected $allowedFields = ['nom_parcours'];

}