
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire</title>
    <style>
	.navi{
    width:100vw;
    height: 8vh;
   background-color: rgb(238, 108, 21);
    font-family:'Roboto', sans-serif;
    text-align:center;
	}
	.space{
    margin-right:15vw ;
    }	
    .container{
    padding-top: 6px;
    display: flex;
    justify-content:flex-end;
    align-items:flex-end ;
    color: rgba(71, 31, 2, 0.829);
    font-weight: bold;
}
.tab{
	width:70vw;
	height:10vh;
    color: rgb(8, 8, 8);
    background-color: rgba(238, 108, 21, 0.459);
    border: 2px solid  rgba(252, 248, 248, 0.897);;
}
.titre{
	width:70vw;
	height:10vh;
 background-color: rgba(5, 4, 4, 0.897);;
    color: white;	
}
table{
	width:100vw;
	text-align:center;
	border-collapse:collapse;
}
.texte{
	width: 15vw;
    height: 5vh;
    color: rgb(8, 8, 8);
    background-color:white;
    border: 2px solid  rgba(238, 108, 21, 0.459);
}
.couleur{
	color:rgb(8, 8, 8);
}
.text{
	width: 8vw;
    height: 4vh;
    
    background-color:white;
    border: 2px solid  rgb(238, 108, 21);
}
<!--
.text:hover{
	background-color: rgba(5, 4, 4, 0.897);;
    color:white;
}
-->
.styl{
	 display:flex;
    justify-content:end;
}
.couleur:hover{
	background-color: rgba(5, 4, 4, 0.897);;
    color:white;
}
.style{
	width: 15vw;
    height: 5vh;
    color: rgb(8, 8, 8);
    background-color:white;
    border: 2px solid  rgba(238, 108, 21, 0.459);
    font-size:1vw;
  
}
.style:hover{
	   background-color: rgb(238, 108, 21);
}
a{
	text-decoration:none;
	
}
    </style>
   </head>
   <body>
	   <nav  class="navi">
        <div class="container">
            <div class="space"><a style="color:white;"href="http://www.mirella.com/index.php/Receive/Afficher/" >Liste of Student</a></div>
        
            <div class="space"><a style="color:white;" href="http://www.mirella.com/index.php/Receive/afficher_formulaire/" >Inscription</a></div>
           
            
        </div>
    </nav> 
<h1>Liste des Utilisateurs</h1>
<form action="http://www.mirella.com/index.php/Receive/Afficher/" method="post">
<label>Rechercher un étudiant:</label>
<input class="texte" type="texte" name="search"/><br>
<div class="styl"><button class="style"><a  href = "http://www.mirella.com/index.php/Receive/Afficher/">See All</a></button></div>
	
</form>
<table >
	<tr class="titre">
	<th>Id_student</th><th>Fullname</th><th>Date of birth</th><th>Gender</th><th>Number</th><th>Address</th><th>Action</th>
	</tr>
	<?php foreach ($anarana as $ligne):?>
	<tr class="tab"><td><?php echo $ligne['id'];
			$id = intval( $ligne['id']);
			$nom = $ligne['name'];
			$birth = $ligne['birth'];
			$sexe = $ligne['sexe'];
			$number = $ligne['number'];
			$addr =  $ligne['address'];
	        ?></td>
		<td><?php echo $ligne['name'];?></td>
	<td><?php echo $ligne['birth'];?></td>
	 <td><?php echo $ligne['sexe'];?></td>

        <td><?php echo $ligne['number'];?></td>
        <td><?php echo $ligne['address'];?></td>
        <td><?php echo "<button class='text'><a class='couleur' href='http://www.mirella.com/index.php/Receive/Delete?del=$id'>delete</a></button>";?><?php echo "<button class='text'><a class='couleur' href='http://www.mirella.com/index.php/Receive/Afficher_formulaire?mod=$id&name=$nom&birt=$birth&genre=$sexe&nbr=$number&address=$addr'>Modify</a></button>";?></td>
	</tr>
	
	<?php endforeach;?>
	</table>
	<?php 
	echo $pager->links();
	?>
</body>
</html>
 
