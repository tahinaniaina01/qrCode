<?php

namespace App\Models;

use CodeIgniter\Model;

class Parcours extends Model
{
    protected $table = 'parcours';
    protected $primarykey = 'id';
    protected $allowedFields = ['nom_parcours'];

}