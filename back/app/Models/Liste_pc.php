<?php
namespace App\Models;
use CodeIgniter\Model;
class Liste_pc extends Model
{
    protected $table = 'personnes';
    protected $primarykey = 'id_personne';
    protected $allowedFields = ['nom','prenoms'];

    public function List($tri){
        $builder = $this->db->table($this->table);
        $builder->select('personnes.nom, personnes.prenoms, inscription.grade, inscription.niveau, machine_etudiants.id_machine,pc.mac_wifi');
        $builder->join('etudiants', 'personnes.id_personne = etudiants.id_personne');
        $builder->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant');
        $builder->join('machine_etudiants', 'inscription.id_inscription = machine_etudiants.id_inscription');
        $builder->join('pc', 'machine_etudiants.id_pc = pc.id_pc');
       
         $result = $builder->get();
         $pres=$result->getResult();
         $nom = [];
         foreach($pres as $line){
            $nom[] = [
                'nom' => $line->nom.' ' . $line->prenoms,
                'grade' => $line->grade.$line->niveau,
                'id' => $this->statut($line->id_machine,$tri),
                'mac'=>$line->mac_wifi
            ];
        }
        // foreach($nom as $n){
        //     $data[] = $this->where('nom',$n['nom'])->where('prenoms',$n[])
        // }
        return $nom ;
    }
    public function statut($id,$tri){
        
        $query = $this->db->table('presence_pc_portable');
        //select * from presence where date(date_presence)='2024-04-30' and id_etudiant=77;
        $query->select('*');
        $query->where('id_pc_etudiant',$id);
        if(empty($tri)){
            $query->where('date(date_operation)',date('Y-m-d'));
        }
        else{
            $query->where('date(date_operation)',$tri);
          //  print_r($tri);
        }
        
        $resultat = $query->get();

        $result = $resultat->getRowArray();
        $nbr = $resultat->getNumRows();

        // if(empty($result)){
        //     return "";
        // }
        // else{
           
            if($nbr>0){
                if($nbr==1) {
                    return "Retrait";
                } else if($nbr==2){
                    return "Remise";
                }else{
                    return "";
                }
            }
            return $nbr;
     //   }

    }
}