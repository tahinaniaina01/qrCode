<?php

namespace App\Models;

use CodeIgniter\Model;

class personnesBDD extends Model
{
    protected $table = 'personnes';
    protected $primarykey = 'id';
    protected $allowedFields = ['nom','prenoms', 'date_naissance', 'lieu_naissance', 'adresse', 'CIN','mail', 'telephone', 'genre','nationalité','id_statut_personne'];
}