<!-- application/views/afficher_utilisateurs.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formulaire</title>
   </head>
   <body>
<h1>Liste des Utilisateurs</h1>
<table border="1">
    <tr>
        <th>Nom</th>
        <th>Date de Naissance</th>
        <th>Genre</th>
        <th>Contact</th>
        <th>Adresse</th>
    </tr>
        <tr>
            <td><?php echo $name; ?></td>
            <td><?php echo $birth; ?></td>
            <td><?php echo $sexe; ?></td>
            <td><?php echo $number; ?></td>
            <td><?php echo $address; ?></td>
        </tr>
	<tr>
	<?php foreach ($anarana as $ligne):?>
	<?php echo $ligne['name'];?>
	<?php endforeach;?>
	</tr>
</table>
</body>
</html>
