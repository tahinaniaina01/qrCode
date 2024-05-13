<?php

class ListePc
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function list($tri)
    {
        $sql = "SELECT personnes.nom, personnes.prenoms, inscription.grade, inscription.niveau, machine_etudiants.id_machine, pc.mac_wifi
                FROM personnes
                JOIN etudiants ON personnes.id_personne = etudiants.id_personne
                JOIN inscription ON etudiants.id_etudiant = inscription.id_etudiant
                JOIN machine_etudiants ON inscription.id_inscription = machine_etudiants.id_inscription
                JOIN pc ON machine_etudiants.id_pc = pc.id_pc";

        $stmt = $this->mysqli->prepare($sql);
        
        $stmt->execute();

        $pres = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        $nom = [];
        foreach ($pres as $row) {
            $nom[] = [
                'nom' => $row['nom']. ' '. $row['prenoms'],
                'grade' => $row['grade']. $row['niveau'],
                'id' =>$this->statut($row['id_machine'],$tri),
                'mac' => $row['mac_wifi']
            ];
        }
        return $nom;
    }
   public function statut($result,$tri) {
        // Ensure $result is an array and contains the necessary keys
        // if (!is_array($result) ||!isset($result['id_inscription'], $result['id_pc'])) {
        //     // Handle the case where $result is not as expected
        //     // For example, return a default value or throw an exception
        //     return "Error: Invalid result";
        // }
    
        $id_inscription = $result['id_inscription'];
        $id_pc_etudiant = $result['id_pc'];
        $date = date('Y-m-d');
    
        // Use $this->mysqli to access the class property
        if(!empty($tri)){
            $sql = "SELECT statut FROM presence_pc_portable WHERE DATE(date_operation) =? AND id_pc_etudiant =?";
            $stmt = $this->mysqli->prepare($sql);
    
            // Bind parameters to prevent SQL injection
            $stmt->bind_param("si", $tri, $id_pc_etudiant);
        }
        else{
            $sql = "SELECT statut FROM presence_pc_portable WHERE DATE(date_operation) =? AND id_pc_etudiant =?";
            $stmt = $this->mysqli->prepare($sql);
        
            // Bind parameters to prevent SQL injection
            $stmt->bind_param("si", $date, $id_pc_etudiant);
        }
     
    
        // Execute the query
        $stmt->execute();
    
        // Get the number of rows
        $nombre = $stmt->num_rows;
    
        if ($nombre > 0) {
            if ($nombre == 1) {
                return "Retrait";
            } else if ($nombre == 2) {
                return "Remise";
            }
        } else {
            return "";
        }
    }
    
}
?>
