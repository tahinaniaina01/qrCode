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
          margin: 5%;
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
        .container-grid{
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap:10px;
        }
        .content{
            background-color: blue;
            padding: 20px;
            margin: 10px;
        }
    </style>
</head>
<body>
    
    <header>

        <nav>
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
                $total++;
            
            endforeach;
        ?>

            <div class="container-grid">
                <a href="Etudiant">
                    <button>
                        <div class="content">
                            <div>Nombre total des etudiants</div>
                            <div><?php echo $total;  ?></div>
                        </div>
                    </button>
                </a>
                <a href="search?pres=Present(e)">
                    <button>
                        <div class="content">
                            <div>Nombre total des presents</div>
                            <div><?php echo $nbrPres;  ?></div>
                        </div>
                    </button>
                </a>
                <a href="search?pres=Absent(e)">
                    <button>
                        <div class="content">
                            <div>Nombre total des absents</div>
                            <div><?php echo $nbrAbs;  ?></div>
                        </div>
                    </button>
                </a>
            </div>

        </nav>

        <form action="search" method="post">
            <label>Rechercher un etudiant:</label>
            <input type="search" name="nom"/>
            
        </form>
        <form action="Trier" method="post">
            <label>Trier par date</label>
            <input type="search" name="date" placeholder="année-mois-jour"/>
        </form>

    </header>

    <button><a href="search?grade=L1">L1</a></button>
    <button><a href="search?grade=L2">L2</a></button>
    <button><a href="search?grade=L3">L3</a></button>
    <button><a href="search?grade=M1">M1</a></button>
    <button><a href="search?grade=M2">M2</a></button>

    <table border="1">
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
      foreach($tout as $line):
        ?>

        
            <?php
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
            ?>
        
        
    <?php 
        endforeach;
    ?>

    </table>
   
</body>
</html>