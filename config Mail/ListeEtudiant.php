<?php

class ListeEtudiant
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function list($tri)
    {
        $sql = "SELECT personnes.nom, personnes.prenoms, inscription.grade, inscription.niveau, inscription.id_inscription FROM personnes INNER JOIN etudiants ON personnes.id_personne = etudiants.id_personne INNER JOIN inscription ON etudiants.id_etudiant = inscription.id_etudiant";

        $stmt = $this->mysqli->prepare($sql);
        
        $stmt->execute();

        $pres = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        $nom = [];
        foreach ($pres as $line) {
            $nom[] = [
                'nom' => $line['nom']. ' '. $line['prenoms'],
                'grade' => $line['grade']. ' '. $line['niveau'],
                'id' => $this->statut($line['id_inscription'], $tri)
            ];
        }
        return $nom;
    }

    public function statut($id, $tri)
    {
        $sql = "SELECT * FROM presence WHERE id_etudiant =?  AND date(date_presence) =?";
        
        $stmt = $this->mysqli->prepare($sql);
        
        $stmt->bind_param("is", $id, $tri);
        $stmt->execute();
    
        $result = $stmt->get_result()->fetch_assoc();
        if (empty($result)) {
            return "Absent(e)";
        } else {
            return "Present(e)";
        }
    }
}

?>
