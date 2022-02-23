<?php
	
	session_start();
	include 'bbdd.php';
	if($_SESSION["usuari"] == "admin"){
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>admin</title>
	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
	<div class="container">
<form action="admin.php" method="post" class="form-control text-center">
		<input type="submit" value="INSERTAR" name="insertar">
		<input type="submit" value="MODIFICAR" name="modificar">
		<input type="submit" value="ELIMINAR" name="eliminar">
	</form>
	<?php
	if(!empty($_POST["insertar"])){
	?>
	<form action="admin.php" method="post" enctype="multipart/form-data">
		nom: <input type="text" name="nom" class="form-control"><br>
		descripcio: <input type="text" name="descripcio" class="form-control"><br>
		preu: <input type="number" name="precio" class="form-control"><br>
		caracteristicas: <input type="text" name="caracteristicas" class="form-control"><br>
		stock: <input type="number"  name="stock" class="form-control"><br>
		imatge: <input type="file" name="fitxer" class="form-control"><br>
		<input type="submit" name="boton">
	</form>
	
	<?php
	}


	
	if(!empty($_POST["modificar"])){
	
	$sql = "SELECT * FROM producte";
	$select2 = mysqli_query($conexio, $sql);
	$hid = $_POST["modificar"];

	echo "<form action='admin.php' method='post'>";
	echo "<input type='hidden' name='modificar' value=".$hid.">";
	echo "<select name='titulo' id='locu' class='form-control'>";
	while($fila2=mysqli_fetch_assoc($select2)){
		echo "<option value='" . $fila2["codiProducte"]. "'>" . $fila2["nom"] . "</option>";
	
	}
	echo "</select><br>";
	echo "<input type='submit' name='mod'>";
	echo "</form>";
	

	

	if(!empty($_POST["mod"])){
		$t = $_POST["titulo"];
		echo $t;
		$sql2 = "SELECT * FROM producte WHERE codiProducte = '$t'";
		$select2 = mysqli_query($conexio, $sql2);
		$hide = $_POST["modificar"];
		echo "<form action='admin.php' method='post' enctype='multipart/form-data'>";
		echo "<input type='hidden' name='modificar' value=".$hide.">";
		echo "<input type='hidden' name='codigo' value=".$t.">";
			while($fila2=mysqli_fetch_assoc($select2)){
							echo "<input type='text' name='newnom' placeholder='nom' class='form-control' value='".$fila2['nom']."'><br>";
							echo "<input type='text' name='newdesc' placeholder='COS' class='form-control' value='".$fila2['descripcio']."'><br>";
							echo "<input type='text' name='newpreu' placeholder='COS' class='form-control' value='".$fila2['preu']."'><br>";
							echo "<input type='text' name='newstock' placeholder='COS' class='form-control' value='".$fila2['stock']."'><br>";
							
							echo "<input type='file' name='fitxer'>";

						}
			echo "<input type='submit' value='modificarr' name='modificarr'>";
		echo "</form>";
	}
}	

	if(!empty($_POST["modificarr"])){
		$t = $_POST["codigo"];
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

		$newnom = $_POST["newnom"];
		$newdesc = $_POST["newdesc"];
		$newpreu = $_POST["newpreu"];
		$newstock = $_POST["newstock"];


		$sql = "UPDATE producte SET nom = '$newnom', descripcio = '$newdesc', preu = '$newpreu', stock = '$newstock', dadesImatge = '$dades_imatge', tipusImatge = '$tipus' WHERE codiProducte = '$t'";	
			
		mysqli_query($conexio, $sql);
		echo $sql;

		echo "<h3 syle='font-family: unique; color: red;'>PRODUCTE MODIFICAT CORRECTAMENT...</h3>";
	}






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
		$descripcio = $_POST["descripcio"];
		$precio = $_POST["precio"];
		$stock = $_POST["stock"];
		$caracteristicas = $_POST["caracteristicas"];
		$sql = "INSERT INTO producte (nom, descripcio, preu, stock, dadesImatge, tipusImatge, info) VALUES ('$nom', '$descripcio', '$precio', '$stock', '$dades_imatge', '$tipus', '$caracteristicas')";	
		mysqli_query($conexio, $sql);
		echo $sql;
		echo "<h1 class='text-center' style=font-family: 'Secular One', sans-serif; '>PRODUCTE <span style='color: red;'>".$nom."</span> AFEGIT CORRECTAMENT...</h1>";
		}	


		if(!empty($_POST["eliminar"])){
			$sql = "SELECT * FROM producte";
			$select2 = mysqli_query($conexio, $sql);
			

			echo "<form action='admin.php' method='post'>";
		
			echo "<select name='titulo' id='locu' class='form-control'>";
			while($fila2=mysqli_fetch_assoc($select2)){
				echo "<option value='" . $fila2["codiProducte"]. "'>" . $fila2["nom"] . "</option>";
			
			}
			echo "</select><br>";
			echo "<input type='submit' name='eli'>";
			echo "</form>";
		}

		if(!empty($_POST["eli"])){
			$codigo = $_POST["titulo"];
			$sql = "DELETE FROM producte WHERE codiProducte = '$codigo'";
			mysqli_query($conexio, $sql);
			echo "<h3 syle='font-family: unique; color: red;'>PRODUCTE ESBORRAT CORRECTAMENT...</h3>";
		}






		// echo "<option value='" . $fila2["codiNoticia"]. "'>" . $fila2["titol"] . "</option>";
	?>
	</div>
</body>
</html>
<?php

	


}
?>