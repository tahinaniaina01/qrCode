<?php
namespace App\Models;

use CodeIgniter\Model;

class Status extends Model
{
    protected $table = 'statut';
    protected $primaryKey = 'id';
   	protected $allowedFields = ['nom_statut'];
}
