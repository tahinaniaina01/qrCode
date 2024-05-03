<?php

namespace App\Controllers;
use App\Models\Liste_etudiant;
class Lister extends BaseController
{
    public function index(): string
    {
        return view('Liste');
    }
    public function Etudiant()
    {
           $list = new Liste_etudiant();
           $reponse['tout'] = $list->List("");

        //    print_r($reponse);
           return view('Liste',$reponse);
    }

    public function search(){
            $grade = $this->request->getVar('grade');
            $cherche = $this->request->getVar('nom');
            $list = new Liste_etudiant();
           $reponse= $list->List("");
           $retour =[];
           $tab = [];
           
            foreach($reponse as $row){
                $value= strstr(strtolower($row['nom']),strtolower($cherche));
            
                if(!empty($value)){
                    
                    $retour[] = $row;
                }
            }

            foreach($retour as $row){
                $val= strstr(strtolower($row['grade']),strtolower($grade));      
                if(!empty($val)){
                    
                    $tab[] = $row;
                }
            }


             return view('Liste',['tout'=>$tab]);
    }

    public function Trier(){
        $tri = $_POST['date'];
      //  print_r($tri);
        $list = new Liste_etudiant();
        $reponse= $list->List($tri);
        $retour =[];
       
        return view('Liste',['tout'=>$reponse]); 
    }
}
