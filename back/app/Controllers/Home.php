<?php

namespace App\Controllers;
use App\Models\Presence;
use App\Models\PresencePC;
use App\Models\Pc;
use App\Models\Personnes;

class Home extends BaseController
{

    public function index()
    {
        //$data = json_decode(file_get_contents("php://input"), true);

        // header('Content-Type: application/json');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        // header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");

        $data['mac'] = "a4:4e:31:e5:85:8c";
        //$data['id'] = "LRAM1020232027";
        $data['id'] = "";

        if(isset($data)){

            /** Recuperation de la valeur du qrcode scannée soit un adresse mac soit un id unique d'un eleve */
            $mac = $data['mac'];
            $id_unique = $data['id'];

            $reponse = "";

            /** On envoie les informations par rapport a la donée recue */
            if(empty($id_unique))
            {
                $machine = new Pc();
                $reponse = $machine->getInformation($mac);

                return view('information', ['result' => $reponse]);
            }
            else
            {
                $eleve = new Personnes();
                $reponse = $eleve->getInformationEtudiant($id_unique);

                return view('information', ['result' => $reponse]);
            }

            if(empty($response))
            {
                $response = array('erreur' => 'Contenu vide');
            }
        }
        else{
            $response = array("error" => "Le contenu est vide");
        }

        echo json_encode($reponse);
    }

    public function presencePc()
    {
        // $data = json_decode(file_get_contents("php://input"),true);

        // header('Content-Type: application/json');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        // header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");

        $presence = new PresencePc();

        $data = $this->request->getJSON(true);
        $data['mac'] = "a4:4e:31:e5:85:8c";
        $data['state'] = "Retrait";

        if (isset($data)) {
            $mac = $data['mac'];
            $statut = $data['state'];
            
            $presence->presencePC($mac, $statut);

            $reponse = ['message' => "$mac et $statut"];

            //return $this->respond($response);
            echo json_encode($reponse);
    
        } else {
            // VIDE
        }
    }

    public function Presence()
    {
        // $data = json_decode(file_get_contents("php://input"),true);

        // header('Content-Type: application/json');
        // header("Access-Control-Allow-Origin: *");
        // header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
        // header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");


        $data = $this->request->getJSON(true);

        $data['id'] = "LRAM1020232027";
        $data['state'] = "present";

        if (isset($data)) {
            $presence = new Presence();

            $id_unique = $data['id'];
            $statut = $data['state'];

            $presence->presence($id_unique);

            $response = ['message' => "$id_unique"];

            echo json_encode($response);
        } else {
            // VIDE
        }
    }


}
