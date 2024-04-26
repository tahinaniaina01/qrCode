<?php

namespace App\Models;

use CodeIgniter\Model;

class Presence extends Model
{
    protected $table = 'presence';
    protected $primarykey = 'id';
    protected $allowedFields = ['id_etudiant','statut','date_presence'];

}