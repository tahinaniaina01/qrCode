<?php

namespace App\Models;
use Codeigniter\Model;

class Pc extends Model
{
    protected $table = 'pc';
    protected $primarykey = 'id_pc';
    protected $allowedFields = ['mac_eth','mac_wifi', 'type_ordinateur', 'etat', 'remarque'];

    public function getInformation($mac)
    {
        $builder = $this->db->table('pc');
        $builder->select('*');
        $builder->join('machine_etudiants', 'pc.id_pc = machine_etudiants.id_pc');
        $builder->where('mac_wifi', $mac);
        $builder->where('pc.type_ordinateur', 1); 

        $query = $builder->get();

        if ($query->getNumRows() > 0) {
            $infos_pc = $query->getRowArray();

            /** si vide */
            if (!$infos_pc) {
                return null;
            }

            $id_inscription = $infos_pc['id_inscription'];
            $builder = $this->db->table('personnes');
            $builder->select('*');
            $builder->join('etudiants', 'personnes.id_personne = etudiants.id_personne');
            $builder->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant');
            $builder->where('id_inscription', $id_inscription);
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
                'statut' => $this->status($infos_pc),
                'id' => $result['id_inscription']
            ];

            return $nom;
        } 
    }

    private function status($result)
    {
        $id_inscription = $result['id_inscription'];
        $id_pc_etudiant = $result['id_pc'];
        $date = date('Y-m-d');

        $query = $this->db->query("SELECT statut FROM presence_pc_portable WHERE DATE(date_operation) = '$date' AND id_pc_etudiant = $id_pc_etudiant");

        $nombre = $query->getNumRows();
        if ($nombre > 0) {
            if ($nombre == 1) {
                return "Remise";
            } else if ($nombre == 2) {
                return "Impossible";
            }
        } else {
            return "Retrait";
        }
    }


    
}