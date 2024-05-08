
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

		$mail->setFrom('fnomenjanahary@mit-ua.mg', 'Team qrcode');
		//$mail->addReplyTo('filamatra@mit-ua.mg', 'Mr Tahiry')
		;

		$mail->addAddress('filamatra@mit-ua.mg', 'Mr Tahiry');
		//$mail->addAddress('trakotosoa@mit-ua.mg', 'Mr Tahiry');

		$mail->isHTML(true);
		$mail->Subject = 'Liste de presence des Etudiants';
		
		// Contenu du tableau
		$tab ="<head> <style>
        :root {
          --primary: #f9b8a6;
          --muted: #f9b8a630;
        }
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
        table {
          border-collapse: collapse;
          width: 80%;
          margin: 5%;
        }
        tr:first-child{
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
		th:first-child{
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
      </style></head>
		<table><tr><th>Nom</th><th>Grade</th><th>Status</th></tr>";
		
		foreach ($students as $student) {
			if($student['id']=="Absent(e)"){
				if($student['grade']=="L2"){
					$tab = $tab . "<tr><td>". $student['nom']. "</td><td>". $student['grade']. "</td></tr>";
				}
			}
		}
		
		$tab = $tab . "</table>";


		$filePath = 'L2.html';
		file_put_contents($filePath, $tab);

		$tab="<table><tr><th>Nom</th><th>Grade</th><th>Status</th></tr>";

		foreach ($students as $student) {
			if($student['id']=="Present(e)"){
				if($student['grade']=="L2"){
					$tab = $tab . "<tr ><td>". $student['nom']. "</td><td>". $student['grade']. "</td></tr>";
				}
			}
		}
		$tab = $tab . "</table>";

		file_put_contents($filePath, $tab, FILE_APPEND);
	
		$wk = '/usr/bin/wkhtmltopdf';
		$pdf = 'L2.pdf';
		$com = "$wk --encoding UTF-8 $filePath $pdf";
		
		exec($com,$output, $returnVar);
		
		if ($returnVar ==0 ){
			echo "La conversion a réussi\n";
		}else{
			echo "Erreur lors de la converssion".implode("\n",$output);	
    	}
		
		/// Corps du message
		$mail->Body    = 'Voici le registre de presence des éléves de L2 en ce jour: '.date('d-m-Y');
		$mail->addAttachment($pdf);

		$mail->send();
		echo "Message has been sent\n";
		
	} catch (Exception $e) {
		echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}\n";
	}
	
	
	function connection(){
			$serverName = 'localhost';
			$username = 'mit';
			$password = '123456';
			$dataBase = 'mit1';
		
			$connect = new mysqli($serverName, $username, $password, $dataBase);
		
			return $connect;
	}

?>

