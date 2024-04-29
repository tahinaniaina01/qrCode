<?php
namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\Query;
class Pc extends Model
{
    protected $table = 'pc';
    protected $primaryKey = 'id';
   	protected $allowedFields = ['mac_eth', 'mac_wifi', 'type_ordinateur','etat','remarque'];
      
      
       public function status($id_etudiant)
       {
           // Assuming $id_etudiant is an array with 'id_pc' key
           $id_pc_etudiant = $id_etudiant['id_pc'];
       
           // Get current date
           $date = date('Y-m-d');
           
           // Prepare the query
           $query = $this->db->table('presence_pc_portable')
                            ->select('*')
                            ->where('DATE(date_operation)', $date)
                            ->where('id_pc_etudiant', $id_pc_etudiant)
                            ->get();
       
           // Get the number of rows returned by the query
           $numRows = $query->getNumRows();
       
           // Determine the status based on the number of rows
           if ($numRows == 1) {
               return "Remise";
           } elseif ($numRows >= 2) {
               return "Impossible";
           } else {
               // Default status if no records found
               return "Retrait";
           }
       }
       
    public function getInformation($mac){
        $query = $this->db->table('pc')
            ->select('*')
            ->join('machine_etudiants', 'pc.id_pc = machine_etudiants.id_pc')
            ->where('mac_wifi', $mac)
            ->where('pc.type_ordinateur',1)
            ->get();
           
        $infos_pc = $query->getRowArray();
        $id_inscription = $infos_pc['id_inscription'];
        $builder = $this->db->table('personnes')
            ->select('*')
            ->join('etudiants', 'personnes.id_personne=etudiants.id_personne')
            ->join('inscription', 'etudiants.id_etudiant=inscription.id_etudiant')
            ->where('id_inscription', $id_inscription)
            ->get();
           
         $getInfos = $builder->getRowArray();
       
         $nom['nom'] = $getInfos['nom'];
         $nom['prenom'] =  $getInfos['prenoms'];
         $grade = $getInfos['grade'];
         $niveau = $getInfos['niveau'];
         $grade= $grade.$niveau;
         $nom['grade'] = $grade;
         $nom['statut'] = $this->status($infos_pc);
 
           $nom['id'] = $getInfos['id_inscription'];
         return $nom;
 }
    
    
}

