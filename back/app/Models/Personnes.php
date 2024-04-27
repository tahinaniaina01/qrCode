<?php

namespace App\Models;

use CodeIgniter\Model;

class Personnes extends Model
{
    protected $table = 'personnes';
    protected $primarykey = 'id';
    protected $allowedFields = ['nom','prenoms', 'date_naissance', 'lieu_naissance', 'adresse', 'CIN','mail', 'telephone', 'genre','nationalité','id_statut_personne'];

    public function getInformationEtudiant($id_unique)
    {
        
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('etudiants', 'personnes.id_personne = etudiants.id_personne');
        $builder->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant');
        $builder->where('etudiants.id_unique', $id_unique);
        $query = $builder->get();
        $result = $query->getRowArray();

        /** si vide */
        if (!$result) {
            return null;
        }

        $nom = [
            'nom' => $result['nom'],
            'prenom' => $result['prenoms'],
            'grade' => $result['grade'] . $result['niveau'],
            'id' => $result['id_inscription'],
            'statut' => $this->status_etudiant($result)
        ];

        return $nom;
    }

    private function status_etudiant($detail_etudiant)
    {
       
        $builder = $this->db->table('presence');
        $builder->select('*');
        $builder->where('id_etudiant', $detail_etudiant['id_etudiant']);
        $builder->where('date(date_presence)', date("Y-m-d"));
        $query = $builder->get();
        $result = $query->getRowArray();

        /** si vide */
        if (!$result) {
            return "Presence"; 
        }
        else{
            return "Vous êtes déjà présent(e)";
        }

    }


}