<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
class Personnes extends Model
{
    protected $table = 'personnes';
    protected $primarykey = 'id';
    protected $allowedFields = ['nom','prenoms', 'date_naissance', 'lieu_naissance', 'adresse', 'CIN','mail', 'telephone', 'genre','nationalité','id_statut_personne'];

    public function getInformationEtudiant($id_unique)
    {
        $query = $this->db->table('personnes')
            ->select('*')
            ->join('etudiants', 'personnes.id_personne = etudiants.id_personne')
            ->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant')
            ->where('etudiants.id_unique', $id_unique)
            ->get();
           
        $detail_etudiant = $query->getRowArray();
     
        $nom = [];
        if ($detail_etudiant) {
            $state =$this->status_etudiant($detail_etudiant); // Assurez-vous que cette fonction est définie quelque part dans votre application
            $nom['nom'] = $detail_etudiant['nom'];
            $nom['prenom'] = $detail_etudiant['prenoms'];
            $grade = $detail_etudiant['grade'];
            $niveau = $detail_etudiant['niveau'];
            $grade = $grade . $niveau;
            $nom['grade'] = $grade;
            $nom['id'] = $detail_etudiant['id_inscription'];

            if ($state == 1) {
                $nom['statut'] = "Vous êtes déjà présent(e)";
            } else {
                $nom['statut'] = "Presence";
            }
        } else {
            $nom['statut'] = "Not Found";
        }

        return $nom;


}
public function status_etudiant($detail_etudiant){
    $date = date("Y-m-d");
    // Utilisez whereRaw pour insérer une expression SQL brute
    $query = $this->db->table('presence')
            ->select('*')
            ->where('id_etudiant', $detail_etudiant['id_etudiant'])
            -> where('date(date_presence)',date("Y-m-d"))  //avec le date_presence est de type datetime dans le base de donner
            ->get();
    $infos_etudiant = $query->getRowArray();
    print_r($infos_etudiant);
  //  $statut = $infos_etudiant['statut'];
    if ($infos_etudiant === null) {
        return "Aucune information trouvée";
    }
    return $infos_etudiant['statut'];
}

}