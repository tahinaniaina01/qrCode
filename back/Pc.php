<?php
namespace App\Models;

use CodeIgniter\Model;

class Pc extends Model
{
    protected $table = 'pc';
    protected $primaryKey = 'id';
   	protected $allowedFields = ['mac_eth', 'mac_wifi', 'type_ordinateur','etat','remarque'];

       public function getInformationEtudiant($id_unique)
       {
           $query = $this->db->table('personnes')
               ->select('*')
               ->join('etudiants', 'personnes.id_personne = etudiants.id_personne')
               ->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant')
               ->where('etudiants.id_unique', $id_unique)
               ->get();
   
           $detail_etudiant = $query->getRowArray();
            $state = 0;
           $nom = [];
           if ($detail_etudiant) {
               $state = status_etudiant($detail_etudiant); // Assurez-vous que cette fonction est définie quelque part dans votre application
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
}
