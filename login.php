<?php
	session_start();
	include 'bbdd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/aleix.css">
	<link rel="stylesheet" href="css/waves.css">
</head>
<body>
	<div class="color">

	<h1 class="tit">LOGIN</h1>
	<div class="container width">

	<form action="login.php" method="post" enctype="multipart/form-data" class="text-center">
		<br><br>	

		<label for="nom">MAIL:</label>
		<input type="text" name="gmail"  class="in" ><br><br>	

		<label for="nom">PASSWORD:</label>
		<input type="password" name="password"  class="in" ><br><br>	
		
		
		<input type="submit" name="boton">
	</form>
</div>


	
<div class="onda">
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(34, 145, 162,0.7)" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(34, 145, 162,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(34, 145, 162,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="rgb(34, 145, 162)" />
                </g>
            </svg>
</div>
</div>
	<?php
	if(!empty($_POST["boton"])){
		$gmail = $_POST["gmail"];
		$password = $_POST["password"];
		$enc = md5($password);
		

		$sql = "SELECT COUNT(*), nom FROM usuari WHERE email = '$gmail' AND password = '$enc' AND admin = 0";

		
			
		$r = mysqli_query($conexio, $sql);

		$fila=mysqli_fetch_assoc($r);

			if($fila["COUNT(*)"] > 0){
				$_SESSION["usuari"] = "client";
				$_SESSION["nom"] = $fila["nom"];

			
				$_SESSION["array_carrito"] = array();
				$sql = "SELECT * FROM producte";
				$select = mysqli_query($conexio, $sql);
					while($fila=mysqli_fetch_assoc($select)){
					$_SESSION["array_carrito"][$fila['codiProducte']] = 0;
				}
				
				



				header("Location: store.php");
			}
		
		$sql2 = "SELECT COUNT(*) FROM usuari WHERE email = '$gmail' AND password = '$enc' AND admin = 1";

		
			
		$r2 = mysqli_query($conexio, $sql2);

		$fila2=mysqli_fetch_assoc($r2);

			if($fila2["COUNT(*)"] > 0){
				$_SESSION["usuari"] = "admin";
				header("Location: admin.php");
			}
		
		

		}

			



	?>
	
</body>
</html>