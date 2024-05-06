<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des etudiants</title>
    <style>
        :root {
          --primary: #f9b8a6;
          --muted: #f9b8a630;
        }
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
        form {
          display: flex;
          justify-content: center;
          margin-bottom: 20px;
        }
        form label {
          margin-right: 10px;
        }
        form input[type="search"] {
          padding: 10px;
          font-size: medium;
          border: 2px solid var(--primary);
          border-radius: 5px;
        }
        form input[type="search"]:focus {
          border-color: var(--muted);
        }
        button {
          background-color: var(--primary);
          color: white;
          padding: 10px 20px;
          font-size: medium;
          border: none;
          border-radius: 5px;
          cursor: pointer;
          margin: 5px;
        }
        button:hover {
          background-color: var(--muted);
        }
        table {
            border-collapse: collapse;
            width: 80%; 
            margin: auto;
            margin-bottom: 5%;
        }
        tr:first-child {
          background-color: var(--primary);
          border: var(--primary) solid 2px;
        }
        tr:first-child th {
          text-align: center;
          padding: 10px 5px;
          font-weight: bold;
          font-size: medium;
        }
        tr:nth-child(even) {
          background: var(--muted);
        }
        td:first-child{
          text-align: left;
          padding-left: 25px;
        }
        td {
          text-align: center;
          padding: 10px 50px;
          font-size: medium;
        }
        tr:not(:first-child) {
          border-right: var(--primary) solid 2px;
          border-left: var(--primary) solid 2px;
        }
        tr:nth-child(2) {
          border-top: var(--primary) solid 2px;
        }
        tr:last-child {
          border-bottom: var(--primary) solid 2px;
        }
        tr td {
          padding: 20px 0px;
        }
        caption{
            font-size: 2vw;
        }
        .container-grid {
            display: flex;
            justify-content: space-around; 
            flex-wrap: wrap; 
            gap: 10px; 
        }
       .dashboard {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }
       .statistic {
            background-color: var(--primary);
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            color: white;
            font-size: 1.2em;
        }
       .statistic:hover {
            background-color: var(--muted);
        }
        .nav-button {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            font-size: medium;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
            text-decoration: none;
        }
        .nav-button:hover {
            background-color: var(--muted);
        }
        .flex {
            display: flex;
            justify-content: space-between;
            /* margin: 0;  */
            margin-top: 30px;
            margin-left: 100px;
            margin-right: 100px;
            bottom: -15px;
        }
        .align{
            align-items: center;
        }
        .lien{
            text-decoration: none;
        }
        #all{
            background: brown;
        }

    </style>
</head>
<body>
    <header>
        <nav>
            <div class="dashboard">
                <?php
                $nbrPres = 0;
                $nbrAbs = 0;
                $total = 0;
            
                foreach($tout as $line):
                    $id = $line['id'];
                    if($id=="Present(e)"){
                        $nbrPres++;
                    }
                    else{
                       $nbrAbs++;
                    }
                    $total = $line['total'];
                endforeach;
               ?>
               <a href="Etudiant" class="lien">
                    <div class="statistic">
                        <strong>Nombre total des étudiants</strong>
                        <br>
                        <?php echo $total; ?>
                    </div>
               </a>
                <a href="search?statut=Present(e)" class="lien">
                    <div class="statistic">
                        <strong>Nombre total des présents</strong>
                        <br>
                        <?php echo $nbrPres; ?>
                    </div>
                </a>
                <a href="search?statut=Absent(e)" class="lien">
                    <div class="statistic">
                        <strong>Nombre total des absents</strong>
                        <br>
                        <?php echo $nbrAbs; ?>
                </div>
                </a>
                
            </div>
        </nav>
    </header>

    <div class="container-grid">
        <a href="search?grade=L1" class="nav-button">L1</a>
        <a href="search?grade=L2" class="nav-button">L2</a>
        <a href="search?grade=L3" class="nav-button">L3</a>
        <a href="search?grade=M1" class="nav-button">M1</a>
        <a href="search?grade=M2" class="nav-button">M2</a>
        <a href="search?grade=all" class="nav-button" id="all">All</a>
    </div>

    <div class="flex">
        <div>
            <form action="search" method="post">
                <div class="align">
                    <label>Rechercher un etudiant:</label>
                    <input type="search" name="nom"/>
                </div>
            </form>
        </div>
        <div>
            <form action="Trier" method="post">
                <div class="align">
                    <label>Trier par date:</label>
                    <input type="search" name="date" placeholder="année-mois-jour"/>
                </div>
            </form>
        </div>
        
    </div>
    
    <table border="0.5">
        <caption>
           <?php echo "Date: ".date('d-m-Y');?>
        </caption>
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
      foreach($statut as $line):
     
            $grade = $line['grade'];
            $nom = $line['nom'];
            $id = $line['id'];

            if($id=="Present(e)"){
              echo " <tr style=\"background-color:green;\"><td> $nom</td> 
                <td>$grade </td>
                <td>$id</td></tr>";

            }
            else{
                echo " <tr><td> $nom</td> 
                  <td>$grade </td>
                  <td>$id</td></tr>";
  
              }
    
        endforeach;
    ?>

    </table>
</body>
</html>
