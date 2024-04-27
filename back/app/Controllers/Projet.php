<?php

namespace App\Controllers;
use App\Models\Presence;
use App\Models\PresencePC;
use App\Models\Pc;
use App\Models\Personnes;

class Projet extends BaseController
{

    public function index(){
        return view('Projet/Scanner');
    }

    public function recupe_qrcode()
    {
        $this->response->setContentType('application/json');

        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');

        $data = $this->request->getJSON(true);

        if(isset($data)){

            /** Recuperation de la valeur du qrcode scannée soit un adresse mac soit un id unique d'un eleve */
            if(isset($data['mac'])){
                $mac = $data['mac'];
            }
            if(isset($data['id'])){
                $id_unique = $data['id'];
            }
            
            $reponse = "";

            /** On envoie les informations par rapport a la donnée recue */
            if(empty($id_unique))
            {
                $machine = new Pc();
                $reponse = $machine->getInformation($mac);

            }
            else
            {
                $eleve = new Personnes();
                $reponse = $eleve->getInformationEtudiant($id_unique);

            }

            if(empty($reponse))
            {
                $reponse = array('erreur' => 'Contenu vide');
            }
        }
        else{
            $reponse = array("error" => "Le contenu est vide");
        }

        echo json_encode($reponse);
    }

    public function PresencePc()
    {
        $this->response->setContentType('application/json');

        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');

        $presence = new PresencePc();

        $data = $this->request->getJSON(true);
        
        if (isset($data)) {
            $mac = $data['mac'];
            $statut = $data['state'];
            
            $presence->presencePC($mac, $statut);

            $reponse = ['message' => "$mac et $statut"];

            echo json_encode($reponse);
    
        } else {
            $response = ['message' => "Le contenu est vide"];

            echo json_encode($response);
        }
    }

    public function Presence()
    {
         $this->response->setContentType('application/json');

        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');


        $data = $this->request->getJSON(true);

        if (isset($data)) {
            $presence = new Presence();

            $id_unique = $data['id'];
            $statut = $data['state'];

            $presence->presence($id_unique);

            $response = ['message' => "$id_unique"];

            echo json_encode($response);
        } else {
            $response = ['message' => "Le contenu est vide"];

            echo json_encode($response);
        }
    }


}