<?php

namespace App\Controllers;
use App\Models\Pc;
class Recupe_qrcode extends BaseController {
    public function index():string{
        $this->response->setContentType('application/json');

        // Ajouter les en-têtes CORS
        $this->response->setHeader('Access-Control-Allow-Origin', '*');
        $this->response->setHeader('Access-Control-Allow-Headers', 'Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');
        $this->response->setHeader('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, DELETE, PUT');
        $data = [
            'message' => 'Hello, World!'
        ];

        return $this->response($data);
    }
//     public function recuperation($data):string{

   
//     if(isset($data)){

//         $mac = $data['mac'];
//         $id_unique = $data['id'];

//         if(empty($id_unique)){
//             $response = getInformation($mac);
//         }
//         else{
//             $response = getInformationEtudiant($id_unique); 
//         }

//         if(empty($response)){
//             $response = array('error'=> 'Empty content');
//         }
//         echo json_encode($response);
//     }
//     else{
//         $variable = array("error"=> "le contenu est vide");
//         echo json_encode($variable);
//     }
//  }
    public function transfer(){
        $id = 4;
        $model = new Pc();
        $result['result'] =$model->getInformationEtudiant($id);
        // echo "result = $result";
     return view('Recherch',$result);
    }
 
}
