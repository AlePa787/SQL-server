<?php 

	require_once("conexion.php");
	$res = $conexion->query("SELECT * FROM tipo");

	while($fila = $res->fetch_assoc()){
		?>
		<section class="tipo">
			<form action="" method="post">
				<input type="hidden" name="tipo" value="<?php echo $fila['Id']?>">
				<input type="submit" name="cargarAvion" value="<?php echo $fila['Modelo']?>">	
				
			</form>
		</section>

		<?php
	}
	if($_SESSION["permiso"]==1){
 ?>
 <section class="tipo" id="agregar">
	<form action="" method="post">
		
			<input type="submit" name="agregarTipo" value="+">	
				
	</form>
</section>
<section class="tipo" id="eliminar">
	<form action="" method="post">
		
			<input type="submit" name="eliminarTipo" value="-">	
				
	</form>
</section>

<section id="reporte">
		<a href="reporte.php">
			<img src="reporte.jpg">
		</a>
</section>
<?php 
	}
	if (isset($_POST["agregarTipo"])) {
		?>
		<form action="" method="post" class="agregar">
			Modelo: <input type="text" name="modelo"> <br>
			<input type="submit" name="nuevoT" value="Agregar">
		</form>
		<?php
	}
	if (isset($_POST["nuevoT"])) {
		require_once("conexion.php");
		$modelo= $_POST["modelo"];
		$conexion->query("INSERT INTO tipo VALUES(null,'$modelo');");
		header("Location: home.php");
	}
	if(isset($_POST["eliminarTipo"])){
		require_once("conexion.php");
		$resultado = $conexion->query("SELECT * FROM tipo");
		?>
			<form action="" method="post" class="eliminar">
				Modelo: 
				<select name="modeloE">
					<?php 
						while($fila = $resultado->fetch_assoc()){
							echo "<option value='".$fila['Id']."'> ".$fila['Modelo']." </option>";
						}
					?>
				</select> <br>
				<input type="submit" name="eliminarT" value="Eliminar">
			</form>
		<?php
	}
	if (isset($_POST["eliminarT"])) {
		require_once("conexion.php");
		$id= $_POST["modeloE"];
		$conexion->query("DELETE FROM tipo WHERE Id=$id");
		header("Location: home.php");
	}
 ?>
