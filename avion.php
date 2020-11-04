<form action="" method="post" class="flecha">
	<input type="hidden" name="regTipo" value="Atras">
	<input type="image" src="FLECHA ATRAS.png">
</form>
<?php 
if (isset($_POST["nuevoM"])) {
		require_once("conexion.php");
		$matricula= $_POST["matricula"];
		$hv= $_POST["hv"];
		$tipo= $_SESSION["tipo"];
		$nombre_tmp = $_FILES["imagen"]["tmp_name"];
        $nombre = $_FILES["imagen"]["name"];
        $conexion->query("INSERT INTO avion VALUES(null,'$tipo','$matricula','$hv','$nombre');");
        move_uploaded_file($nombre_tmp, "img/$nombre");
	}
	if (isset($_POST["eliminarM"])) {
		require_once("conexion.php");
		$id= $_POST["matriculaE"];
		$conexion->query("DELETE FROM avion WHERE Id=$id");
		
	}
	require_once("conexion.php");
	$res = $conexion->query("SELECT * FROM avion WHERE id_tipo=".$_SESSION["tipo"]);
	$tipo = $_SESSION["tipo"];
	while($fila = $res->fetch_assoc()){
		?>
		<section class="avion">
			<form action="" method="post">
				<input type="hidden" name="avion" value="<?php echo $fila['Matricula']?>">
				<input type="image" name="cargarPosicion" src="img/<?php echo $fila['Imagen']?>">
				<?php echo $fila['Matricula']; ?>	
			</form>
		</section>
		<?php
	}
	if($_SESSION["permiso"]==1){
 ?>
 <section class="tipo" id="agregar">
	<form action="" method="post">
			
			<input type="submit" name="agregarMatricula" value="+">	
	</form>
</section>
<section class="tipo" id="eliminar">
	<form action="" method="post">
			
			<input type="submit" name="eliminarMatricula" value="-">	
				
	</form>
</section>
<?php 
}
if (isset($_POST["agregarMatricula"])) {
		?>
		<form action="" method="post" class="agregar" enctype="multipart/form-data">
			Matricula: <input type="text" name="matricula"> <br>
			HV: <input type="text" name="hv"> <br>
			Imagen: <input type="file" name="imagen"> <br>
			<input type="submit" name="nuevoM" value="Agregar">
		</form>
		<?php
	}
	if(isset($_POST["eliminarMatricula"])){
		require_once("conexion.php");
		$tipo = $_SESSION["tipo"];
		$resultado = $conexion->query("SELECT * FROM avion WHERE Id_tipo=$tipo");
		?>
			<form action="" method="post" class="eliminar">
				Matricula: 
				<select name="matriculaE">
					<?php 
						while($fila = $resultado->fetch_assoc()){
							echo "<option value='".$fila['Id']."'> ".$fila['Matricula']." </option>";
						}
					?>
				</select> <br>
				<input type="submit" name="eliminarM" value="Eliminar">
			</form>
		<?php
	}
 ?>
 <section class="tipo" id="grafica">
	<form action="grafica.php" method="post">
			<?php
			require_once("conexion.php");
			$res = $conexion->query("SELECT Modelo FROM tipo WHERE Id=".$_SESSION["tipo"]);
			$fila = $res->fetch_assoc();
			?>
			<input type="submit" name="grafica" value="Gráfica de Cambios <?php echo $fila['Modelo'];?>">	
				
	</form>
</section>
<section class="tipo" id="manual">
		<?php
			require_once("conexion.php");
			$res = $conexion->query("SELECT Modelo FROM tipo WHERE Id=".$_SESSION["tipo"]);
			$fila = $res->fetch_assoc();
			?>
			<a href="<?php echo "pdf/".$fila['Modelo'].".pdf";?>">
			<input type="button" name="manual" value="Manual de Mazas">	
		</a>
</section>