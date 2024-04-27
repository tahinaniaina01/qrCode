<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire</title>
<!--
    <link rel="stylesheet" href="https://www.mezumi.fr/codeIgniter/style.css">
-->
<style>
	*{
    box-sizing: border-box;
    padding: 0%;
    margin:0%
}
body{
    background-color: rgba(255, 255, 255, 0.74); 
}
.box{
    width: 25vw;
    height: 75vh;
    background-color: white;
    border-radius: 8%;
    box-shadow: 4px 4px 4px 4px  rgba(15, 15, 15, 0.719);
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 1.3vw;
    
}
.box1{
    width: 20vw;
    height: 60vh;
    background-color: white;
    border-radius: 8%;
    box-shadow: 4px 4px 4px 4px  rgba(15, 15, 15, 0.719);
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    font-size: 1.3vw;
    padding-top: 6%;
    
}
.tab1{
   
    margin-left: 25%;
    margin-top: 4%;
}
.boite{
    margin-top: 5%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.tab{
    margin-left: 18%;
    margin-top: 4%;
}
.esp{
    /* padding-top: 8%;
    margin-bottom: 12%; */
    width: 15vw;
    height: 9vh;
}
.save{
    width: 15vw;
    height: 5vh;
    margin-top: 10%;
    background-color: rgb(238, 108, 21);
    color: white;
    font-weight: bold;
}
.save:hover{
    background-color: rgba(5, 4, 4, 0.897);;
    color: white;
}
input{
    width: 15vw;
    height: 5vh;
    color: rgb(8, 8, 8);
    background-color: rgba(238, 108, 21, 0.459);
    border: 2px solid  rgba(252, 248, 248, 0.897);;
}
.navi{
    width:100vw;
    height: 8vh;
    background-color: rgb(238, 108, 21);
    font-family:'Roboto', sans-serif;
    text-align:center;
}
input:hover{
    background-color: rgba(5, 4, 4, 0.637);; 
    color: white;
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

</style>

</head>
<body>

	<nav  class="navi">
        <div class="container">
             <div class="space"><a style="color:white;" href="http://www.mirella.com/index.php/Receive/Afficher/" >Liste of Student</a></div>
        
            <div class="space"><a style="color:white;" href="http://www.mirella.com/index.php/Receive/afficher_formulaire/" >Inscription</a></div>
           
            
        </div>
    </nav> 
	<?php if(isset($_GET['mod'])){
		$id = $_GET['mod'];
		$nom = $_GET['name'];
		$birth = $_GET['birt'];
		$sexe = $_GET['genre'];
		$number = $_GET['nbr'];
		$addr =  $_GET['address'];
		echo "<div class='boite'>
    <div class='box'>
        <table class='tab'>
            
            <form action='http://www.mirella.com/index.php/Receive/modify' method='post'>
                <tr class='esp'><th> Signup Form</Form:get>
                <tr><td>
                <label>Fullname</label>
                </tr></td>
                <tr><td>
              
                <input type='text' name='nom' value= \"$nom\"/>
                </tr></td>
              
                <tr><td><label for='2'>Date of birth</label></td></tr>
                <tr><td><input type='date' name='date' value = \"$birth\"/></td></tr>
                <tr><td><label for='3'>Gender</label></td></tr>
                <tr><td><input type='text' name='genre' value = \"$sexe\"/></td></tr>
                <tr><td><label>Contact</label></td></tr>
                <tr><td><input type='text' name='nbr' value = \"$number\"/></td></tr>
                <tr><td> <label for='4'>Address</label></td></tr>
                <tr><td> <input type='text' name = 'addr' value = \"$addr\"></td></tr>
                <input type = 'hidden' name='idd' value =\"$id\"/>
                <tr><td><input class = 'save' type='submit' value='Save'/></td></tr>
            </form>
        </table>
    </div>
    <div>";
	}
	else{
		 echo "<div class='boite'>
		 <div class='box'>
        <table class='tab'>
            
            <form action='http://www.mirella.com/index.php/Receive/enregistrer_utilisateur' method='post'>
                <tr class='esp'><th> Signup Form</Form:get>
                <tr><td>
                <label>Fullname</label>
                </tr></td>
                <tr><td>
              
                <input type='text' name='nom'/>
                </tr></td>
              
                <tr><td><label for='2'>Date of birth</label></td></tr>
                <tr><td><input type='date' name='date'/></td></tr>
                <tr><td><label for='3'>Gender</label></td></tr>
                <tr><td><input type='text' name='genre'/></td></tr>
                <tr><td><label>Contact</label></td></tr>
                <tr><td><input type='text' name='nbr'/></td></tr>
                <tr><td> <label for='4'>Address</label></td></tr>
                <tr><td> <input type='text' name = 'addr'></td></tr>
                <tr><td><input class = 'save' type='submit' value='Save'/></td></tr>
            </form>
        </table>
    </div>
    <div>";
		}?>
<!--
    <div class="boite">
    <div class="box">
        <table class="tab">
            
            <form action="http://www.mirella.com/index.php/Receive/enregistrer_utilisateur" method="post">
                <tr class="esp"><th> Signup Form</Form:get>
                <tr><td>
                <label>Fullname</label>
                </tr></td>
                <tr><td>
              
                <input type="text" name="nom"/>
                </tr></td>
              
                <tr><td><label for="2">Date of birth</label></tr></td>
                <tr><td><input type="date" name="date"/></tr></td>
                <tr><td><label for="3">Gender</label></tr></td>
                <tr><td><input type="text" name="genre"/></tr></td>
                <tr><td><label>Contact</label></tr></td>
                <tr><td><input type="text" name="nbr"/></tr></td>
                <tr><td> <label for="4">Address</label></tr></td>
                <tr><td> <input type="text" name = "addr"></tr></td>
                <tr><td><?php// echo "<input class = 'save' type='submit' value='Save' name ='$id'/>";?></tr></td>
            </form>
        </table>
    </div>
    <div>
-->
</body>
</html>
