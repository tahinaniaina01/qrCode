<?php

class ListePc {
	
    private $conn;

    public function __construct($mysqli)
    {
        $this->conn = $mysqli;
    }

    public function listPc($grade,$niveau) {
        $sql = "SELECT personnes.nom, personnes.prenoms, inscription.grade, inscription.niveau, machine_etudiants.id_machine, pc.mac_wifi FROM personnes INNER JOIN etudiants ON personnes.id_personne = etudiants.id_personne INNER JOIN inscription ON etudiants.id_etudiant = inscription.id_etudiant INNER JOIN machine_etudiants ON inscription.id_inscription = machine_etudiants.id_inscription INNER JOIN pc ON machine_etudiants.id_pc = pc.id_pc where inscription.grade='$grade' and inscription.niveau=$niveau";

        $result = $this->conn->prepare($sql);
        
        $result->execute();
        
        $donnee = $result->get_result()->fetch_all(MYSQLI_ASSOC);

        $data = [];
        $retrait = 0;
        $remise = 0;
        
        foreach ($donnee as $row) {
			$position = $this->statut($row['id_machine']);
			
			if($position=="Retrait"){
				$retrait++;
			}
			else if($position=="Remise"){
				$remise++;
			}
			
            $data[] = [
                'total' => $result->num_rows,
                'retrait' => $retrait,
                'remise' => $remise,
                'nom' => $row['nom']. ' '. $row['prenoms'],
                'grade' => $row['grade']. $row['niveau'],
                'id' => $position ,
                'mac' => $row['mac_wifi']
            ];
        }

        return $data;
    }

    private function statut($id) {
        $date = date('Y-m-d');
        $sql = "SELECT * FROM presence_pc_portable WHERE id_pc_etudiant =? and date(date_operation)=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("is", $id,$date);
        $stmt->execute();
        $result = $stmt->get_result();

        $nbr = $result->num_rows;
        if($nbr > 0) {
            if($nbr == 1) {
                return "Retrait";
            } else if($nbr == 2) {
                return "Remise";
            } else {
                return "";
            }
        }
        return "";
    }
}

?>
