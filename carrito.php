<?php
$subtotal = 0;
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
	<link rel="stylesheet" href="css/waves.css">
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
	$cantidad = $_SESSION["cantidad"];
	if(!empty($_POST["compra"])){
		
		
		
		$user = $_SESSION["usuari"];
		$compra = "INSERT INTO compra (data, email) VALUES (SYSDATE(), '$user')";

		$select = mysqli_query($conexio, $compra);

		$numeroCompra = "SELECT MAX(codiCompra) from compra";

			$comp = mysqli_query($conexio, $numeroCompra);
			$fila2=mysqli_fetch_assoc($comp);

		$numero =$fila2["MAX(codiCompra)"];

		foreach ($_SESSION["array_carrito"] as $key => $value) {
		
		
								// echo "<p style='font-family: open sans;margin-top: 40px;'>".$key."</p>";
								// echo "<p style='font-family: open sans;margin-top: 40px;'>".$value."</p>";	
		if($value > 0){
			for($i = 0; $i < $value; $i++){
				$comanda = "INSERT INTO comanda (codiCompra, codiProducte) VALUES ('$numero', '$key')";
				$select = mysqli_query($conexio, $comanda);

				$update = "UPDATE producte set stock = stock - $cantidad WHERE codiProducte = '$key'";
				$select1 = mysqli_query($conexio, $update);
				// echo $update;
		 		// echo $comanda."<br>";
			}
			
		}
		 
					}
				
		

	$_SESSION["array_carrito"] = array();
	$sql = "SELECT * FROM producte";
	$select = mysqli_query($conexio, $sql);
	while($fila=mysqli_fetch_assoc($select)){
	$_SESSION["array_carrito"][$fila['codiProducte']] = 0;
	
				}
	
	// $update = "UPDATE producte set stock = stock - $cantidad";
	// $select1 = mysqli_query($conexio, $update);
	// echo $update;

	?>
	<script type="text/javascript">

    $(document).ready(function() {
        swal({
            title: "Fet!",
            text: "Producte pagat correctament!!",
            icon: "success",
            button: "Ok",
            timer: 2000
        });
    });
</script>
<?php
	}
	if(empty($_POST["carrito"])){
			
			echo "<div class='container'>";
			
			echo "<table>";
				echo "<tr>";
					echo "<th>Producto</th>";
					echo "<th>Nombre</th>";
					echo "<th>Precio</th>";
					echo "<th>Cantidad</th>";
					echo "<th>Total</th>";
				echo "</tr>";
			if($_SESSION["array_carrito"] > 0){
	
				foreach ($_SESSION["array_carrito"] as $key => $value) {
					if($value != 0){
						
						$sql = "SELECT * FROM producte WHERE codiProducte = '$key'";
						$select = mysqli_query($conexio, $sql);
						echo "<div class='row'>";
						while($fila=mysqli_fetch_assoc($select)){

						echo "<tr>";
							echo "<td>";
								echo '<br><img class="imagen_carrito2" src="data:'.$fila["tipusImatge"].';base64,'.base64_encode($fila["dadesImatge"]).'"/>';
							echo "</td>";
							echo "<td>";
								echo "<p style='font-family: open sans; margin-top: 40px; margin-left: 10px'>".$fila['nom']."</p>";
							echo "</td>";
							
							
							echo "<td>";
								echo "<p style='font-family: open sans;margin-top: 40px;'>".$fila['preu']."€</p>";
							echo "</td>";

							echo "<td>";
								echo "<p style='font-family: open sans;margin-top: 40px;'>".$value."</p>";
							echo "</td>";
							echo "<td>";

							$total = $fila["preu"] * $value;
							$subtotal += $total;
								echo "<p style='font-family: open sans;margin-top: 40px;'>".$total."€</p>";
							echo "</td>";
							echo "<br><br>";
						}

						
					

					}

				}
				echo "</table>";

				echo "<div class='container' style='position: relative; left: 300px; width: 100px'>";
					echo "<p style='font-family: open sans;margin-top: 40px;'>Subtotal: </p>";
					echo $subtotal."€";
				echo "</div>";
				echo "<br><br><br>";
				echo "<form action='carrito.php' method='post' style='margin-left: 800px'>";
							echo "<input type='submit' value='Finalitzar compra' name='compra' class='btn btn-success'>";
						echo "<form>";
			}
	
		echo "</div>";
		
		
	}

	?>
	

	<div class="onda2">
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
</body>
</html>