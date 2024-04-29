<?php

namespace App\Controllers;
use App\Models\UtilisateurModel;
use App\Models\InsertDatabase;
class Receive extends BaseController {

    public function afficher_formulaire():string{
        // Charger la vue 'formulaire'
       // $this->load->view('formulaire');
         //$this->view('formulaire');
       
		return view('formulaire');
    }


    public function enregistrer_utilisateur(){
        // Récupérer les données du formulaire
        $data = array(
             'name' => $_POST['nom'],
            'birth' => $_POST['date'],
            'sexe' => $_POST['genre'],
            'number' =>  $_POST['nbr'],
            'address' =>  $_POST['addr']
        );
		$mode = new InsertDatabase();
		$mode->insertUtilisateur($data);

	//return view ('Afficher');
	return redirect()->to('/Receive/Afficher');
    }
     public function Afficher() :string{
		$number = 5;
		$model = new UtilisateurModel();
		//$d ['anarana']=$model->getdata();
		$d ['anarana']=$model->pagination($number);
		$d['pager'] = $model->pager;
		if(isset($_POST['search'])){
			$srch = array(
					'nom'=> $_POST['search']);
		
			$model = new Utilisateurmodel();
			$retour['anarana'] = $model->search($srch,$number);
			$retour['pager'] =$model->pager;
			return view('Afficher',$retour);
		}
		else{
		return view('Afficher',$d);
		}
	return view('Afficher',$d);
    }
    public function SeeTout():string{
		$model = new UtilisateurModel();
		$d ['anarana']=$model->getdata();
		//~ $d['count'] = $model->counter();
		//~ $retour['anarana'] = $model->paginate(intval($d['count']));
		//~ $retour['pager'] =$model->pager;
		return view('Afficher',$d);
	}
   public function Delete(){
		$srch = $_GET['del'];
		$model = new Utilisateurmodel();
		$model->supprimer(intval($srch));
		return redirect()->to('/Receive/Afficher');
		//return view('Recherche',$srch);
	}
	public function modify(){
		 $data = array(
             'name' => $_POST['nom'],
            'birth' => $_POST['date'],
            'sexe' => $_POST['genre'],
            'number' =>  $_POST['nbr'],
            'address' =>  $_POST['addr'],
            'id'=>$_POST['idd']
        );
			$mode = new InsertDatabase();
			$mode-> modify(intval($data['id']),$data);
			return redirect()->to('/Receive/Afficher');
        //return view('Recherche',['id'=>$data['id']]);
       // return view('Afficher',$data);
		
	}

}
