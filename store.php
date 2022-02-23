<?php
	
	session_start();
	include 'bbdd.php';

	if($_SESSION["usuari"] == "client"){

		if(!empty($_POST['mes'])){
				$selected = $_POST["selected"];

				$_SESSION["escollida"] = $selected;

				header("Location: bamba.php");

			}
		?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MartinezStore</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/store.css">
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

         <li><a href="carrito.php"><img src="image/cart.png" alt="" style="width: 20px;"></a></li>
       
    
   		 </ul>
	</div>
</div>
</nav>
	<div class="color">
		<div class="container">
			<div class="row">
				<div class="col-md-5">

					<h1 style="font-family: univers; color: white; font-size: 4em">BAMBAS <br> EXCLUSIVAS</h1><br><br>
					<h4 style="font-family: unique; color: white; font-size: 2em; font-weight: lighter">30% de descuento en todos nuestros productos</h4>
				</div>
				<div class="col-md-7">
					<img src="image/imagen.webp" alt="" class="bambas">
				</div>
				
			</div>
		</div>
	</div>
<br><br>
	<div class="container">
		<div class="row">
			<div class="col-md-4 text-center categoria" style="height: 410px">
				<h1 style="font-family: univers; color: white">Running</h1>
				<h2 style="font-family: unique; font-size: 1.2em; color: white;">Desde 95€</h2>
				<img src="image/sport.png" alt="" style="width: 300px;">
			</div>
			<div class="col-md-4 text-center categoria2">
				<h1 style="font-family: univers; color: white">Powerlifting</h1>
				<h2 style="font-family: unique; font-size: 1.2em; color: white;">Desde 110€</h2>
				<img src="image/bambas-2.png" alt="" style="width: 300px; -webkit-transform:rotate(297deg);">
			</div>
			<div class="col-md-4 text-center categoria3">
				<h1 style="font-family: univers; color: white">Basquet</h1>
				<h2 style="font-family: unique; font-size: 1.2em; color: white;">Desde 110€</h2><br><br>
				<img src="image/basquet.png" alt="" style="width: 300px; -webkit-transform:rotate(297deg);">
				<br><br><br><br><br>
			</div>
		</div>
	</div>
	<br><br><br>
	<div class="container">
		<h1 style="font-family: univers; text-align: center">Tots els productes</h1>
		<?php
			$sql = "SELECT COUNT(*) FROM producte";
			$r = mysqli_query($conexio, $sql);
			$fila=mysqli_fetch_assoc($r);
		?>
		<h4 style="font-family: univers; text-align: center">Actualment hi han <?php $fila["COUNT(*)"] ?> productes</h4>
	<?php
		$bambas = "SELECT * FROM producte";
		$select = mysqli_query($conexio, $bambas);
		echo "<div class='row'>";
			while($fila=mysqli_fetch_assoc($select)){
				echo "<div class='col-md-4'>";	

 					echo "<div style='border: 2px solid #BABABA;
					border-radius: 10px;' class='text-center'>";

		 				echo '<img class="imagenes" src="data:'.$fila["tipusImatge"].';base64,'.base64_encode($fila["dadesImatge"]).'"/>'. "<br><br>";

		 			echo "</div>";

		 				echo "<br><p style='font-family: univers; margin-left: 10px'>".$fila["nom"]."</p>";
		 				echo "<br><p style='font-family: univers; margin-left: 10px; color: gray;'>".$fila["preu"]."€</p>";
		 				echo "<form acton='store.php' method='post'>";
		 						?>
						<input type="hidden" value="<?php echo $fila['codiProducte'] ?>" name="selected">
		 						<?php
			 					echo "<input type='submit' value='Veure mes' name='mes'>";
			 				echo "</form>";
			echo "</div>";	
			}
			echo "</div>";	
			?>




	</div>

</body>
</html>
<?php
}

?>