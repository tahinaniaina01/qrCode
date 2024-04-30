<?php

namespace App\Models;

use CodeIgniter\Model;

class PresencePC extends Model
{
    protected $table = 'presence_pc_portable';
    protected $primarykey = 'id';
    protected $allowedFields = ['id_pc_etudiant','date_operation', 'status'];

    public function presencePC($mac, $statut)
    {
       
        $builder = $this->db->table('pc');
        $builder->select('*');
        $builder->join('machine_etudiants', 'pc.id_pc = machine_etudiants.id_pc');
        $builder->where('mac_wifi', $mac);
        $builder->where('type_ordinateur', 1);
        $query = $builder->get();
        $result = $query->getRowArray();

        /** si vide */
        if (!$result) {
            return false; 
        }

        $id_pc_etudiant = $result['id_pc'];

        $builder = $this->db->table('presence_pc_portable');
        $data = [
            'id_pc_etudiant' => $id_pc_etudiant,
            'statut' => $statut
        ];
        $builder->insert($data);

        return true; 
    }
}