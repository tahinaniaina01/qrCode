<?php

namespace App\Controllers;
use App\Models\Liste_etudiant;

class Lister extends BaseController
{
    
    public function index()
    {
        return redirect()->to('Lister/Etudiant');
    }

    public function Etudiant()
    {
        $list = new Liste_etudiant();
        $reponse['tout'] = $list->List("");
        $reponse['statut'] = $list->List("");

        return view('Liste',$reponse);
    }

    public function search()
    {
        // Charger la bibliothèque de session
        helper(['session']);

        $grade = $this->request->getVar('grade');
        $cherche = $this->request->getVar('nom');
        $statut = $this->request->getVar('statut');
        $list = new Liste_etudiant();
        $reponse = $list->List("");
        $retour = [];
        $tab = [];
        $data = [];
        $niveau = "";
        $recherche = "";
        $position = "";

        if($grade=="Restaurer"){
            $grade = "";
            $cherche = "";
            $statut = "";
        }

        // Avoir les données dans les variables de session dont nom si il y eu recherche, grade et le statut
        // tout ceci est par rapport au recherche effectué par l'utilisateur
        $niveau = $this->getData('grade', $grade);
        $recherche = $this->getData('nom', $cherche);
        $position =  $this->getData('statut', $statut);

        /// Triage pour avoir le resultat final de liste
        $retour = $this->triage($reponse, 'nom', $recherche);
        $tab = $this->triage($retour, 'grade', $niveau);
        $data = $this->triage($tab, 'id', $position);

        $bd = array(
            'tout' => $tab,
            'statut' => $data
        );

        return view('Liste', $bd);
    }

    public function getData($cle, $compare){
        $valeur="";
        if (session()->has($cle)) {
            $valeur = session()->get($cle);
            if($compare !== NULL){
                if($valeur !== $compare){
                    session()->set($cle, $compare);
                    $valeur = session()->get($cle);
                }
            }
            
        } else {
            session()->set($cle, $compare);
            $valeur = $compare;
        }
        return $valeur;
    }

    public function triage($tableau, $cle, $recherche){
        $tab = [];
        foreach($tableau as $row){
            $val= strstr(strtolower($row[$cle]),strtolower($recherche));      
            if(!empty($val)){
                $tab[] = $row;
            }
        }
        return $tab;
    }

    public function Trier(){
        $tri = $_POST['date'];

        $list = new Liste_etudiant();
        $reponse= $list->List($tri);
        $retour =[];
       
        return view('Liste',['tout'=>$reponse]); 
    }
}
