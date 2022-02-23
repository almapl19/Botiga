<?php
	include 'bbdd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Register</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/aleix.css">
</head>
<body style="background-color: #E37D7D;">
	<h1 class="tit">REGISTER</h1>
	<div class="container width">

	<form action="registre.php" method="post" enctype="multipart/form-data" class="text-center">
		<label for="nom">NOM:</label>
		<input type="text" name="nom"  class="in" id="nom"><br><br>	

		<label for="nom">COGNOM:</label>
		<input type="text" name="cognom"  class="in"><br><br>	

		<label for="nom">MAIL:</label>
		<input type="gmail" name="gmail"  class="in" ><br><br>	

		<label for="nom">POBLACIO:</label>
		<input type="text" name="poblacio" class="in"><br><br>	

		<label for="nom">DIRECCIO:</label>
		<input type="text" name="direccio"  class="in" ><br><br>	

		<label for="nom">CPOSTAL:</label>
		<input type="text" name="cpostal"  class="in" ><br><br>	

		<input type="file" name="fitxer"class="in" ><br>	
		
		<label for="nom">PASSWORD:</label>
		<input type="password" name="password"  class="in" ><br><br>	
		
		
		<input type="submit" name="boton">
	</form>
</div>

	<?php
		if(!empty($_POST["boton"])){
				
				if(is_uploaded_file($_FILES["fitxer"]["tmp_name"])){

							if($_FILES["fitxer"]["type"] == "image/png" || $_FILES["fitxer"]["type"] == "image/jpg" || $_FILES["fitxer"]["type"] == "image/gif" || $_FILES["fitxer"]["type"] == "image/jpeg"){


							$tipus = $_FILES["fitxer"]["type"];
							$nom_foto = $_FILES["fitxer"]["tmp_name"];
							$dades_imatge = file_get_contents($_FILES["fitxer"]["tmp_name"]);
							
							$dades_imatge = mysqli_real_escape_string($conexio, $dades_imatge);

							
						}else{
							echo "Formato erroneo";
						}
					}

		$nom = $_POST["nom"];
		$cognom = $_POST["cognom"];
		$gmail = $_POST["gmail"];
		$poblacio = $_POST["poblacio"];
		$direccio = $_POST["direccio"];
		$cpostal = $_POST["cpostal"];
		$password = $_POST["password"];
		$enc_password = md5($password);

		$sql = "INSERT INTO usuari (email, password, nom, cognoms, direccio, poblacio, cPostal, dadesFoto, tipusFoto) VALUES ('$gmail', '$enc_password', '$nom', '$cognom', '$direccio', '$poblacio', '$cpostal', '$dades_imatge', '$tipus')";
			
		mysqli_query($conexio, $sql);
			echo $sql;
			
		echo "<h1 class='text-center' style='color: white; font-family: 'Secular One', sans-serif; '>USUARI <span style='color: red;'>".$nom."</span> AFEGIT CORRECTAMENT...</h1>";
		}	

	?>
	
</body>
</html>