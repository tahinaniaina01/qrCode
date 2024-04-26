<?php

namespace App\Models;

use CodeIgniter\Model;

class Ordinateurs extends Model
{
    protected $table = 'ordinateur';
    protected $primarykey = 'id';
    protected $allowedFields = ['type_ordinateur'];

}