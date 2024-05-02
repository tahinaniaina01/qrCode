<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
	
	require 'ListeEtudiant.php';
	require 'vendor/autoload.php';
	
	/// main code
	
	$mysqli = connection();
	if ($mysqli->connect_error) {
		die("Connection failed: ". $mysqli->connect_error);
	}

	$tri = date('Y-m-d'); 
	$listeEtudiant = new ListeEtudiant($mysqli);
	$students = $listeEtudiant->list($tri);
	
	$mail = new PHPMailer(true);
	
	print_r($students);
	
	try {
	   
		$mail->isSMTP();
		$mail->Host = 'mail.mit-ua.mg';
		$mail->SMTPAuth = true;
		$mail->Username = 'fnomenjanahary@mit-ua.mg';
		$mail->Password = 'G}Tc4jE%{c?+';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 587;

		$mail->setFrom('fnomenjanahary@mit-ua.mg', 'Nomenjanahary');
		$mail->addReplyTo('mfock@mit-ua.mg', 'Fock');

		$mail->addAddress('mfock@mit-ua.mg', 'Fock');

		$mail->isHTML(true);
		$mail->Subject = 'Test email from PHP';
		
		// Contenu du tableau
		$tab = $tab . "<table><tr><th>Nom</th><th>Grade</th><th>Status</th></tr>";
		
		echo "<table width='100%' style='border-collapse: collapse;'>";
		echo "<tr><th>Nom</th><th>Grade</th><th>Status</th></tr>";
		
		foreach ($students as $student) {
			$tab = $tab . "<tr><td>". $student['nom']. "</td><td>". $student['grade']. $student['id'] . "</td><td>". $student['statut']. "</td></tr>";
		}
		
		$tab = $tab . "</table>";
		
		/// Corps du message
		$mail->Body    = 'Voici la liste de presence en ce jour.' . $tab;

		$mail->send();
		echo "Message has been sent\n";
		
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
	}
	
	
	function connection(){
			$serverName = 'localhost';
			$username = 'mit';
			$password = '123456';
			$dataBase = 'mit';
		
			$connect = new mysqli($serverName, $username, $password, $dataBase);
		
			return $connect;
	}

?>
