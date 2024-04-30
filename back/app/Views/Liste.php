<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des etudiants</title>
</head>
<body>
    <form action="search" method="post">
        <label>Rechercher un etudiant:</label>
        <input type="search" name="nom"/>
        
    </form>
    <form action="Trier" method="post">
        <label>Trier par date</label>
        <input type="search" name="date" placeholder="année-mois-jour"/>
    </form>
    <table border="1">
        <thead>
           <?php echo "Date: ".date('d-m-Y');?>
        </thead>
        <tr>
            <th>
                Nom et prenoms
             </th>
            <th>
                Grade
            </th>
            <th>
                Status
            </th>
        </tr>
      <?php  
      foreach($tout as $line):
        ?>

        
            <?php
            $grade = $line['grade'];
            $nom = $line['nom'];
            $id = $line['id'];
            if($line['id']==="Present(e)"){
              echo " <tr bgcolor='green'><td> $nom</td> 
                <td>$grade </td>
                <td>$id</td></tr>";

            }
            else{
                echo " <tr><td> $nom</td> 
                  <td>$grade </td>
                  <td>$id</td></tr>";
  
              }
            ?>
        
        
    <?php 
        endforeach;
    ?>

    </table>
    <button><a href="Lister/Licence1">L1</a></button>
    <button><a href="Lister/Licence2">L2</a></button>
    <button><a href="Lister/Licence3">L3</a></button>
    <button><a href="Lister/Master1">M1</a></button>
    <button><a href="Lister/Master2">M2</a></button>
</body>
</html>