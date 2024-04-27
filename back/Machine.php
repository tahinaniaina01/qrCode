<?php
namespace App\Models;

use CodeIgniter\Model;

class Machine extends Model
{
    protected $table = 'machine_etudiants';
    protected $primaryKey = 'id';
   	protected $allowedFields = ['id_inscription', 'id_pc', 'remise'];
//     public function joindre(){
//         $this->db->select('*');
//         $this->db->from('table1');
//         $this->db->join('table2', 'table1.id = table2.table1_id');
//         $query = $this->db->get();

//     }
 }
