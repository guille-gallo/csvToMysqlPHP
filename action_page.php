<?php

session_start();

$validUser = $_SESSION["valid"] === true;

if($validUser) {

	$servername = "localhost";
	$username = "";
	$password = "";
	$dbname = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$dni = $_GET["dni"];

	if ($dni !== NULL) {
	
		$sql = "SELECT * FROM table_name WHERE DNI = '$dni'";
		$result = mysqli_query($conn, $sql);

		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {			
				$DNI = $row["DNI"];
				$NombreApellido = $row["Nombre"]. " " . $row["Apellido"];
				$NROBLC = $row["BLC_NRO"];
			}
		} else {
			echo '<!DOCTYPE html>
			<html>
				<head>
					<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
					<meta name="viewport" content="width=device-width, initial-scale=1.0">
					<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
					<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />					
				</head>
				<body>
					<div class="container">
						<h2>¡Hola, ingresá el DNI del asociado!</h2>
						<div class="form_container">
						<form class="consulta" action="action_page.php" method="get">
							<span>DNI asociado:</span><br>
							<input type="number" name="dni">
							<br><br>
							<input type="submit" value="Consultar" class="input_consulta">
						</form>
						<div class="beneficiado">
							<img src="./not-success.png" /><br>
							<span style="display:block;">Beneficio</span>
							<span style="font-weight:bold;display:block;">NO disponible</span>
						</div>			
						<form class="logout" action="logout.php" method="post">
							<input type="submit" value="Cerrar sesión" class="input_cerrar_sesion">
						</form>  
					</div>
				</body>
			</html>';
			die();
		}

		echo '<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
				<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />				
			</head>
			<body>
				<div class="container">
					<h2>¡Hola, ingresá el DNI del asociado!</h2>
					<div class="form_container">
					<form class="consulta" action="action_page.php" method="get">
						<span>DNI asociado:</span><br>
						<input type="number" name="dni">
						<br><br>
						<input type="submit" value="Consultar" class="input_consulta">
					</form>
					<div class="beneficiado"> 
						<img src="./success.png" /><br>
						<span>'; 
						echo $NombreApellido; 
						echo '</span><br><span id="dni_label">'; 
						echo "DNI: "; 
						echo '</span>'; 
						echo $DNI;
						echo '<br><span id="blc_label">'; 
						echo "Nro. BLC: </span>"; 
						echo $NROBLC;
						echo '</div>
						<form class="logout" action="logout.php" method="post">
							<input type="submit" value="Cerrar sesión" class="input_cerrar_sesion">
						</form>
					</div>			  
				</div>
			</body>
		</html>';

		mysqli_close($conn);

	} else {

		echo '<!DOCTYPE html>
		<html>
			<head>
				<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
				<meta name="viewport" content="width=device-width, initial-scale=1.0">
				<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
				<link rel="stylesheet" type="text/css" href="styles.css" media="screen" />
			</head>
			<body>
				<div class="container">
					<h2>¡Hola, ingresá el DNI del asociado!</h2>
					<div class="form_container">
					<form class="consulta" action="action_page.php" method="get">
						<span>DNI asociado:</span><br>
						<input type="number" name="dni">
						<br><br>
						<input type="submit" value="Consultar" class="input_consulta">
					</form>
					<div class="beneficiado">
					</div>			  
					<form class="logout" action="logout.php" method="post">
							<input type="submit" value="Cerrar sesión" class="input_cerrar_sesion">
					</form>
				</div>
			</body>
		</html>';
	}
} else {
	header("Location: farmaciaLogin.html");
}

?>