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
            $cherche = $_POST['nom'];
            $list = new Liste_etudiant();
           $reponse= $list->List("");
           $retour =[];
            foreach($reponse as $row){
                $value= strstr(strtolower($row['nom']),strtolower($cherche));
                if(!empty($value)){
                    
                    $retour[] = $row;
                   //print_r($row);
                }
                //print_r($retour);
                // print_r($row);
            }
             return view('Liste',['tout'=>$retour]);
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
