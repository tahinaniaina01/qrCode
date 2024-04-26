<?php

namespace App\Models;

use CodeIgniter\Model;

class inscriptionBDD extends Model
{
    protected $table = 'inscription';
    protected $primarykey = 'id';
    protected $allowedFields = ['num_inscription','id_etudiant', 'grade', 'niveau', 'annee_inscription', 'statut','id_parcours'];

}