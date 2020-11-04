<form action="" method="post" class="flecha">
	<input type="hidden" name="regAvion" value="Atras">
	<input type="image" src="FLECHA ATRAS.png">
</form>
<form action="" method="post" class="agregar">
	Lugar: <br>
	Across<input type="radio" value="across" name="lugar">
	Embraer<input type="radio" value="embraer" name="lugar"> <br>

	S/N MAZA
	<input type="text" name="serie" required> <br><br>
	LG: 
	<select name="lg">
		<option value="mlg">MLG</option>
		<option value="nlg">NLG</option>
	</select> <br>
	Posición:
	<select name="posicion">
		<option value="LH">LH</option>
		<option value="RH">RH</option>
		<option value="LHI">LHI</option>
		<option value="RHI">RHI</option>
		<option value="LHO">LHO</option>
		<option value="RHO">RHO</option>
	</select> <br>
	Movimiento: 
	<select name="movimiento" id="movimiento">
		<option value="INS">Instalación</option>
		<option value="REM">Remoción</option>
	</select> <br>

	<label id="horas">INS AC FH</label>

	<input type="text" name="horasavion"> <br>

	<label id="ciclos">INS AC CY</label>

	<input type="text" name="ciclosavion"> <br>

	 Fecha: <input type="date" name="fecha"> <br>

	Comentario: <input type="text" name="comments"> <br>

	<input type="submit" name="altaMovimiento" value="Guardar">
</form>

<script type="text/javascript">
	var cambio=0;
	var combo = document.getElementById("movimiento");
	combo.addEventListener("change",texto);

	function texto(){
		if(cambio==0){
			document.getElementById("horas").innerHTML = "REM AC FH";
			document.getElementById("ciclos").innerHTML = "REM AC CY";
			cambio = 1;
		}else{
			document.getElementById("horas").innerHTML = "INS AC FH";
			document.getElementById("ciclos").innerHTML = "INS AC CY";
			cambio = 0;
		}
	}
 //Se utiliza Java script para hacer interaccion de cambios sin tener que enviar información a la base de datos
 /*Varias lineas*/
</script>
<?php 
if (isset($_POST["altaMovimiento"])) {
		require_once("conexion.php");
		$lg = $_POST["lg"];
		$posicion = $_POST["posicion"];
		$movimiento = $_POST["movimiento"];
		$fecha = $_POST["fecha"];
		$avion = $_SESSION["avion"];
		$serie = $_POST["serie"];
		$lugar = $_POST["lugar"];
		$horas = $_POST["horasavion"];
		$ciclos = $_POST["ciclosavion"];
		$com = $_POST["comments"];

		if($movimiento=="INS"){
			$resultado = $conexion->query("SELECT COUNT(*) FROM movimiento WHERE serie='$serie' AND remocion='0000-00-00'");
			$fila = $resultado->fetch_assoc();
			if($fila["COUNT(*)"]>0){
				echo "<h1>Esa maza ya esta instalada</h1>";
			}else{
			$resultado = $conexion->query("SELECT cambio FROM movimiento WHERE serie='$serie' ORDER BY cambio DESC LIMIT 1");
			if($resultado->num_rows==0){
				$cambio = 0;
			}else{
				$fila = $resultado->fetch_assoc();
				$cambio = $fila["cambio"];
			}
			$conexion->query("INSERT INTO movimiento VALUES(null,'$avion','$lg','$posicion','$fecha','0000-00-00','$serie','$lugar','$cambio','$horas',0,'$ciclos',0,0,0,'$com');");
			echo "<h1>Guardado</h1>";
		}
		}
		if($movimiento=="REM"){
			$resultado = $conexion->query("SELECT Id,cambio,INS_AC_FH,INS_AC_CY, comments FROM movimiento WHERE serie='$serie' AND remocion='0000-00-00'");
			$fila = $resultado->fetch_assoc();
			$id = $fila["Id"];
			$cambio = $fila["cambio"];
			$cambio = $cambio + 1;

			$insfh = $fila["INS_AC_FH"];
			$inscy = $fila["INS_AC_CY"];

			$fhwheel = $horas - $insfh;
			$cywheel = $ciclos - $inscy;

			$com = $fila["comments"].",".$com;

			$conexion->query("UPDATE movimiento SET remocion='$fecha',cambio='$cambio',REM_AC_FH='$horas',REM_AC_CY='$ciclos',FH_WHEEL='$fhwheel',CY_WHEEL='$cywheel',comments='$com' WHERE Id = '$id'");
				if($cambio%5==0 || $fhwheel>=1500){
					echo "<h1>Necesita Overhaul</h1>";
				}else{
					echo "<h1>Necesita Eddy Current</h1>";
				}
				$res = $conexion->query("SELECT FH_WHEEL,CY_WHEEL FROM movimiento WHERE serie='$serie'");
				$suma = 0;
				$sumaC = 0;
				while($fila = $res->fetch_assoc()){
					$suma = $suma + $fila["FH_WHEEL"];
					$sumaC = $sumaC + $fila["CY_WHEEL"];
				}
				echo "<h1>Las horas y ciclos totales de esta maza son: <br> FH: $suma <br> CY: $sumaC </h1>";
		}
		
}
 ?>
 <table>
	<tr>
		<th>Matricula</th>
		<th>LG</th>
		<th>Posición</th>
		<th>Instalación</th>
		<th>Serie</th>
	</tr>
	<?php
		require_once("conexion.php");
		$resultado = $conexion->query("SELECT * FROM movimiento WHERE remocion='0000-00-00'");
		while($fila=$resultado->fetch_assoc()){
			echo "<tr>";
			echo "<td>".$fila['Matricula']."</td>";
			echo "<td>".$fila['lg']."</td>";
			echo "<td>".$fila['posicion']."</td>";
			echo "<td>".$fila['instalacion']."</td>";
			echo "<td>".$fila['serie']."</td>";
			echo "<tr>";
		}
	?>
</table>