<?php

namespace App\Controllers;
use App\Models\Liste_pc;
class ListerPc extends BaseController
{
    public function index(): string
    {
        $list = new Liste_pc();
        $reponse['tout'] = $list->List("");

     //    print_r($reponse);
        return view('ListPC',$reponse);
    }
    public function Machine()
    {
           $list = new Liste_pc();
           $reponse['tout'] = $list->List("");

        //    print_r($reponse);
           return view('ListPC',$reponse);
    }

    public function search(){
            $grade = $this->request->getVar('grade');
            $cherche = $this->request->getVar('nom');
            $list = new Liste_pc();
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


             return view('ListPC',['tout'=>$tab]);
    }

    public function Trier(){
        $tri = $_POST['date'];
      //  print_r($tri);
        $list = new Liste_pc();
        $reponse= $list->List($tri);
        $retour =[];
       
        return view('ListPC',['tout'=>$reponse]); 
    }
}
