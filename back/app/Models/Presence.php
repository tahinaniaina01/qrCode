<?php

namespace App\Models;

use CodeIgniter\Model;

class Presence extends Model
{
    protected $table = 'presence';
    protected $primarykey = 'id';
    protected $allowedFields = ['id_etudiant','statut','date_presence'];


    public function presence($id_unique)
    {
        
        $builder = $this->db->table('personnes');
        $builder->select('*');
        $builder->join('etudiants', 'personnes.id_personne = etudiants.id_personne');
        $builder->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant');
        $builder->where('etudiants.id_unique', $id_unique);
        $query = $builder->get();
        $result = $query->getRowArray();

        if ($result) {
            $id_etudiant = $result['id_inscription'];
            $builder = $this->db->table('presence');
            $data = [
                'id_etudiant' => $id_etudiant,
                'statut' => 1
            ];
            $builder->insert($data);
        }
    }
}
