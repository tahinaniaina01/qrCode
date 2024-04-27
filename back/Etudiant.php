<?php
namespace App\Models;

use CodeIgniter\Model;

class Etudiant extends Model
{
    protected $table = 'etudiants';
    protected $primaryKey = 'id';
   	protected $allowedFields = ['id_personne', 'id_unique', 'annee_bacc', 'num_bacc'];

}
