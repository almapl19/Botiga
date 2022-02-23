<?php
	session_start();
	include 'bbdd.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>MartinezStore</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/store.css">
	<script src="https://kit.fontawesome.com/04018441a1.js" crossorigin="anonymous"></script>
	 <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-default bajar" style="margin-bottom: 0px;">
  <div class="container-fluid">
      <div class="navbar-header">

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <img src="image/store_icon.png" alt="" style="width: 50px; display: inline-block">            
    </div>		
  <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">              
        <li><p id="hol" style="color: white; font-family: univers; font-size: 2em"></p></li>
        <li><a href="store.php" class="custom-navbar"><span class="loc">HOME</span></a></li>
        <li><a href="login.php" class="custom-navbar"><span class="loc">LOGIN</span></a></li>
        <li><a href="carrito.php"><img src="image/cart.png" alt="" style="width: 20px;"></a></li>
       
    
   		 </ul>
	</div>
</div>
</nav>


	<?php

	// if(!empty($_POST["compra"])){
	// 	$user = $_SESSION["usuari"];
	// 	$compra = "INSERT INTO compra (data, email) VALUES (SYSDATE(), '$user')";

	// 	$select = mysqli_query($conexio, $compra);

	// 	$numeroCompra = "SELECT MAX(codiCompra) from compra";

	// 		$comp = mysqli_query($conexio, $numeroCompra);
	// 		$fila2=mysqli_fetch_assoc($comp);

	// 	$numero =$fila2["MAX(codiCompra)"];

	// 	foreach ($_SESSION["array_carrito"] as $key => $value) {
		
		
	// 							// echo "<p style='font-family: open sans;margin-top: 40px;'>".$key."</p>";
	// 							// echo "<p style='font-family: open sans;margin-top: 40px;'>".$value."</p>";	
	// 	if($value > 0){
	// 		for($i = 0; $i < $value; $i++){
	// 			$comanda = "INSERT INTO comanda (codiCompra, codiProducte) VALUES ('$numero', '$key')";
	// 			$select = mysqli_query($conexio, $comanda);
	// 	 		// echo $comanda."<br>";
	// 		}
			
	// 	}
		 
	// 				}
				
		

	// $_SESSION["array_carrito"] = array();
	// $sql = "SELECT * FROM producte";
	// $select = mysqli_query($conexio, $sql);
	// while($fila=mysqli_fetch_assoc($select)){
	// $_SESSION["array_carrito"][$fila['codiProducte']] = 0;
	// $fila["stock"] = $fila["stock"] - $_SESSION["cantidad"];
	// 			}
	// }

	if(!empty($_POST["carrito"])){
		
		$cant = $_POST["cant"];
		$_SESSION["cantidad"] = $cant;

		$_SESSION["producte_escollit"] = $_SESSION["escollida"];

		$_SESSION["array_carrito"][$_SESSION['producte_escollit']] += $cant;

		
		// print_r($_SESSION["array_carrito"]);
		?>
		<script type="text/javascript">
    $(document).ready(function() {
        swal({
            title: "Fet!",
            text: "Producte afegit al carrito!!",
            icon: "success",
            button: "Ok",
            timer: 2000
        });
    });
</script>
<?php
		
		
	}

		$escollida = $_SESSION['escollida'];
		

		$sql = "SELECT * FROM producte WHERE codiProducte = $escollida";

		
			
		$select = mysqli_query($conexio, $sql);
		echo "<div class='container'>";
		echo "<div class='row'>";
			while($fila=mysqli_fetch_assoc($select)){
				
				echo "<div class='col-md-6' style='border: 1px solid #D9D9D9; border-radius: 10px'>";
					echo '<img class="imagenes2" src="data:'.$fila["tipusImatge"].';base64,'.base64_encode($fila["dadesImatge"]).'"/>'. "<br><br>";
				echo "</div>";
				
				echo "<div class='col-md-6'>";
					echo "<h1 style='font-family: univers; font-size: 4em'>".$fila["nom"]."</h1>";
					echo "<h1 style='font-family: univers; font-size: 2em'>".$fila["preu"]."€</h1>";
					echo "<i style='color: #EFEF00;' class='fa fa-star'></i>";
					echo "<i style='color: #EFEF00;' class='fa fa-star'></i>";
					echo "<i style='color: #EFEF00;' class='fa fa-star'></i>";
					echo "<i style='color: #EFEF00;' class='fa fa-star'></i>";
					echo "<i style='color: #EFEF00;' class='fa fa-star'></i>";
					echo "<hr style='border: 1px solid black'>";
					echo "<p style='font-family: open sans;'>".$fila["descripcio"]."</p>";
						echo "<p style='font-family: open sans;'>Stock disponible: ".$fila["stock"]."</p>";
					echo "<form action='bamba.php' method='post'>";
						echo "<input type='number' style='width: 50px; margin-right: 10px' name='cant' requiered value='1' min='0' max=".$fila["stock"].">";
						echo "<input type='submit' value='Añadir al carrito' class='btn btn-danger' name='carrito'>";

					echo "</form>";

				echo "</div>";

				}

		echo "</div>";

		?>
		<hr style="border: 2px solid black">
			<form action="bamba.php" method="post" class="text-center">
				<input type="submit" value="Informacio" name="info" style="border: none; background: none; font-family: univers; font-size: 2em; border-right: 1px solid black">
				<input type="submit" value="Valoració" name="valoracio" style="border: none; background: none; font-family: univers; font-size: 2em;">
			</form>
		<?php

		if(empty($_POST["info"]) OR !empty($_POST["info"])){
			// $info = $_POST["info"];

			$info = "SELECT * FROM producte WHERE codiProducte = $escollida";

		
			
				$select = mysqli_query($conexio, $info);
			
			while($fila=mysqli_fetch_assoc($select)){
				echo "<br><div style='border: 1px solid #CFCFCF; padding: 10px'>";
					echo "<p style='font-family: open sans;'>".$fila["info"]."</p>";
				echo "</div>";
				
			}
		}

		if(!empty($_POST["valoracio"])){
			$valoracio = $_POST["valoracio"];
			$val = "SELECT * FROM valoraciones WHERE codiProducte = $escollida";
			$mostrar_valoraciones = mysqli_query($conexio, $val);
			
			while($fila=mysqli_fetch_assoc($mostrar_valoraciones)){
				echo "<br><br>";
				echo "<div style='border: 1px solid gray; padding: 10px'>";
					if($fila["valoracio"] == 1){
						echo "<i style='color: black;' class='fa fa-star'></i>";
					}
					if($fila["valoracio"] == 2){
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
					}
					if($fila["valoracio"] == 3){
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
					}
					if($fila["valoracio"] == 4){
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
					}
					if($fila["valoracio"] == 5){
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";
						echo "<i style='color: black;' class='fa fa-star'></i>";

					}	

					echo "<br><br>";
					echo "<p style='font-family: open sans;'>".$fila["titol"]."</p>";
					echo "<p style='font-family: open sans;'>".$fila["comentari"]."</p>";
				
				echo "</div>";
			}
			?>
				<form action="bamba.php" method="post">
					<input type="hidden" name="valoracio">
					<input type="submit" name="afegir" value="Afegir una valoració">

				</form>


			<?php
			}
				if(!empty($_POST["afegir"])){
					
					?>
						<br><br><br>
						<form action="bamba.php" method="post" class="text-center" style="border: 1px solid #D8D7D7;">
							Valoració general:
							<input type="radio" name="valoracio" value="1" class="valoracio">
							<input type="radio" name="valoracio" value="2" class="valoracio">
							<input type="radio" name="valoracio" value="3" class="valoracio">
							<input type="radio" name="valoracio" value="4" class="valoracio">
							<input type="radio" name="valoracio" value="5" class="valoracio">
							<br><br>
							Títol del comentari:
							<input type="text" name="titol"><br><br><br>
							Comentari:
							<textarea name="comentari" ></textarea><br><br>
							<input type="submit" class="btn" name="boto_valoracio">
							
							<input type="hidden" name="afegir">
						</form>
					<?php
				}

				if(!empty($_POST["boto_valoracio"])){
					$nota = $_POST["valoracio"];
					$titol = $_POST["titol"];
					$comentari = $_POST["comentari"];
					$nom_usuari = $_SESSION["nom"];
					$insertar = "INSERT INTO valoraciones (valoracio, nomUsuari, codiProducte, titol, comentari) VALUES ('$nota', '$nom_usuari', '$escollida', '$titol', '$comentari')";
					$select = mysqli_query($conexio, $insertar);
					echo $insertar;
				}
			
		

		echo "</div>";
	?>

</body>
</html>