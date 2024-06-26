<?php
namespace App\Models;
use CodeIgniter\Model;
class Liste_etudiant extends Model
{
    protected $table = 'personnes';
    protected $primarykey = 'id_personne';
    protected $allowedFields = ['nom','prenoms'];

    public function List($tri){
        $builder = $this->db->table($this->table);
        $builder->select('*');
        $builder->join('etudiants', 'personnes.id_personne = etudiants.id_personne');
        $builder->join('inscription', 'etudiants.id_etudiant = inscription.id_etudiant');
       
        $result = $builder->get();
        $pres=$result->getResult();
        $nom = [];
        foreach($pres as $line){
            $nom[] = [
                'total' => $result->getNumRows(),
                'nom' => $line->nom.' ' . $line->prenoms,
                'grade' => $line->grade.$line->niveau,
                'id' => $this->statut($line->id_inscription,$tri)
            ];
        }
       
        return $nom ;
    }
    public function statut($id,$tri){
        
        $query = $this->db->table('presence');
       
        $query->select('*');
        $query->where('id_etudiant',$id);
        if(empty($tri)){
            $query->where('date(date_presence)',date('Y-m-d'));
        }
        else{
            $query->where('date(date_presence)',$tri);
         
        }
        
        $resultat = $query->get();
        $result = $resultat->getRowArray();
        if(empty($result)){
            return "Absent(e)";
        }
        else{
            return "Present(e)";
        }

    }
}