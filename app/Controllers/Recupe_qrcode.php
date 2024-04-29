<?php

namespace App\Controllers;
use App\Models\Pc;
use App\Models\Personnes;
use App\Models\PresencePC;
use App\Models\Presence;    

class Recupe_qrcode extends BaseController {
    public function index(): string {

        $data = json_decode(file_get_contents("php://input"), true);

        $this->response->setContentType('application/json');

        // Ajouter les en-têtes CORS
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');

        if (isset($data)) {
            // $response;
            // if(!isset($data['id'])){
            //     $response = ["statu" => "ok"];
            // }
            if(isset($data['id'])){
                $id_unique = $data['id'];
            }
            if(isset($data['mac'])){
                $mac = $data['mac'];
            } 
            // $mac = isset($data['mac']) ? $data['mac'] : null;
            // $id_unique = isset($data['id']) ? $data['id'] : null;
            
            if (empty($id_unique)) {
                $mode = new Pc();
                $response =$mode->getInformation($mac);
            } else {
                $model = new Personnes();
                $response = $model->getInformationEtudiant($id_unique);
            }

            if (empty($response)) {
                $response = array('error' => 'Empty content');
            }
                // return $this->response->setJSON($response);
            return json_encode($response);

        } else {

            $variable = array("error" => "le contenu est vide");
            return json_encode($variable);
        }
    }

    public function transfert(){

        $pc = new Pc();
        $response = $pc->getInformation("34:02:86:c8:37:5f");
        return json_encode($response);

    }
    public function PresencePc() : string
    {

        $data = json_decode(file_get_contents("php://input"), true);
        $this->response->setContentType('application/json');

        // Ajouter les en-têtes CORS
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');

        if (isset($data)) {

            $presence = new PresencePC();
            $mac = $data['mac'];
            $state = $data['state'];
          
            $presence->presencePC($mac, $state);
            $response = ['status'=> true];
               
        }

        return json_encode($response);     
    }

    // public function Presence():string{

    //     $data = json_decode(file_get_contents("php://input"), true);
    //     $this->response->setContentType('application/json');
    //    // $data = $this->request->getJSON();

    //     // Ajouter les en-têtes CORS
    //     $this->response->setHeader('Access-Control-Allow-Origin', '*');
    //     $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
    //     $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');

    //     if (isset($data)) {
    //         $presence = new Presence();
    //         $id_unique = $data['id'];
    //         $state = $data['state'];
          
    //         $presence->presence($id_unique);
    //         $response = ['status'=> true];
               
    //     }
    //     return json_encode($response);     

    // }
    public function Presence():string
    {

        $data = json_decode(file_get_contents("php://input"),true);

        // Définition des en-têtes spécifiques pour cette réponse
        $this->response->setHeader('Content-Type', 'application/json');
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');

        $data = $this->request->getJSON();

        // $data['id'] = "LRAM1020232027";
        // $data['state'] = "present";

        if (isset($data)) {
            $presence = new Presence();

            $mac = $input['mac'] ?? null;
            $id = $input['id'] ?? null;

            $presence->presence($id_unique);

            $response = ['status' => true];

            return json_encode($response);
        } 
    }

    
}
    
