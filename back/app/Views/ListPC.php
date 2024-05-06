<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des machines</title>
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
                    $nbrRetrait = 0;
                    $nbrRemise = 0;
                    $total = 0;
                    foreach($tout as $line):
                        $id = $line['id'];
                        if($id=="Retrait"){
                            $nbrRetrait++;
                        }
                        else if($id=="Remise"){
                           $nbrRemise++;
                        }
                        $total = $line['total'];
                    endforeach;
               
               ?> 
               <a href="ListerPc/Machine" class="lien">
                    <div class="statistic">
                        <strong>Nombre total des machines </strong>
                        <br>
                        <?php echo $total; ?>
                    </div>
               </a>
                <a href="recherche?statut=Retrait" class="lien">
                    <div class="statistic">
                        <strong>Nombre total des retraits </strong>
                        <br>
                        <?php echo $nbrRetrait; ?>
                    </div>
                </a>
                <a href="recherche?statut=Remise" class="lien">
                    <div class="statistic">
                        <strong>Nombre total des remises </strong>
                        <br>
                        <?php echo $nbrRemise; ?>
                </div>
                </a>
                
            </div>
        </nav>
    </header>

    <div class="container-grid">
        <a href="recherche?grade=L1" class="nav-button">L1</a>
        <a href="recherche?grade=L2" class="nav-button">L2</a>
        <a href="recherche?grade=L3" class="nav-button">L3</a>
        <a href="recherche?grade=M1" class="nav-button">M1</a>
        <a href="recherche?grade=M2" class="nav-button">M2</a>
        <a href="recherche?grade=all" class="nav-button" id="all">All</a>
    </div>

    <div class="flex">
        <div>
            <form action="recherche" method="post">
                <div class="align">
                    <label>Rechercher un etudiant:</label>
                    <input type="search" name="nom"/>
                </div>
            </form>
        </div>
        <div>
            <form action="TrierDate" method="post">
                <div class="align">
                    <label>Trier par date:</label>
                    <input type="search" name="date" placeholder="année-mois-jour"/>
                </div>
            </form>
        </div>
        
    </div>

    <table border="1">
        <caption>
           Date : <?php echo date('d-m-Y');?>
    </caption>
        <tr>
            <th>
                Grade
            </th>
            <th>
                Nom et prenoms
             </th>
             <th>
                Mac Wifi
             </th>
             <th colspan="2">
                Status
            </th>
        </tr>
      <?php  
      foreach($statut as $line):

            $grade = $line['grade'];
            $nom = $line['nom'];
            $id = $line['id'];

            $in = null;   $out=null;
           
            if($id=="Retrait"){
                $in="Retrait";
            }
            else if($id=="Remise"){
                $in = "Retrait";
                $out = "Remise";
            }

            $mac = $line['mac'];

            if(!empty($in)&& empty($out)){
                echo " <tr style=\"background-color: purple;\"> <td>$grade </td>
                <td> $nom</td> 
                <td>$mac</td>
                <td>$in</td>
                <td>$out</td>
                </tr>";
            }
            else if( $in=="Retrait" && $out=="Remise" ){
                echo " <tr style=\"background-color: blue;\"> <td>$grade </td><td> $nom</td> 
                <td>$mac</td>
                <td>$in</td>
                <td>$out</td>
                </tr>";
            }
            else {
                echo " <tr> <td>$grade </td><td> $nom</td>  
                <td>$mac</td>
                <td>$in</td>
                <td>$out</td>
                </tr>";
            }

        endforeach;
   ?>

    </table>
   
</body>
</html>
