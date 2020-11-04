<?php

 	session_start();
 	$modelo = $_SESSION["tipo"];

?>

<!doctype html>
<html>

<head>
	<title>Line Styles</title>
	<script src="Chart.min.js"></script>
	<script src="utils.js"></script>
	<style>
	canvas{
		-moz-user-select: none;
		-webkit-user-select: none;
		-ms-user-select: none;
	}
	.agregar{
			text-align: center;
			background-color: white;
			border-radius: 15px;
			padding: 1em;
			margin: 0 auto;
			width: 40%;
		}
		.agregar input{
			border: 1px solid lightblue;
			padding:0.2em;
			font-size: 0.8em;
			margin-top: 0.7em;
		}
		.agregar input[type="submit"]{
			background-color: black;
			color: white;
		}
		.agregar select{
			margin-bottom: 1em;	
		}
		.flecha input[type="image"]{
			width: 50px;
		}
	</style>
</head>

<body>
	<form action="home.php" method="post" class="flecha">
	<input type="hidden" name="regAvion" value="Atras">
	<input type="image" src="FLECHA ATRAS.png">
</form>
	<?php
		require_once("conexion.php");
			$res = $conexion->query("SELECT Modelo FROM tipo WHERE Id=".$_SESSION["tipo"]);
			$fila = $res->fetch_assoc();
		if(isset($_POST["anio"])){
			$año = $_POST["anio"];
	?>
	<div style="width:75%;">
		<canvas id="canvas"></canvas>
	</div>
	<script>
		var config = {
			type: 'line',
			data: {
				labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
				datasets: [{
					label: 'Mazas <?php echo $fila["Modelo"] ?>',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						<?php obtenerTotal($modelo,1,$año,31); ?>,
						<?php obtenerTotal($modelo,2,$año,29); ?>,
						<?php obtenerTotal($modelo,3,$año,31); ?>,
						<?php obtenerTotal($modelo,4,$año,30); ?>,
						<?php obtenerTotal($modelo,5,$año,31); ?>,
						<?php obtenerTotal($modelo,6,$año,30); ?>,
						<?php obtenerTotal($modelo,7,$año,31); ?>,
						<?php obtenerTotal($modelo,8,$año,31); ?>,
						<?php obtenerTotal($modelo,9,$año,30); ?>,
						<?php obtenerTotal($modelo,10,$año,31); ?>,
						<?php obtenerTotal($modelo,11,$año,30); ?>,
						<?php obtenerTotal($modelo,12,$año,31); ?>,
						
					],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: ''
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Meses'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Cambios'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
	</script>
	<?php
		}else{
			?>
			<form action="" method="post" class="agregar">
				Año <input type="number" name="anio"><br>
				<input type="submit" name="Graficar">
				
			</form>
			<?php
		}
	?>
</body>

</html>
<?php

	function obtenerTotal($modelo,$mes,$anio,$dia){
		$conexion = new mysqli("localhost", "root", "", "ruedas");
		$resultado = $conexion->query("SELECT COUNT(*) FROM movimiento m,avion a,tipo t WHERE m.Matricula = a.Matricula AND a.Id_tipo =$modelo AND a.Id_tipo = t.Id AND remocion BETWEEN '$anio-$mes-01' AND '$anio-$mes-$dia';");
		$fila = $resultado->fetch_assoc();
		echo $fila["COUNT(*)"];
	}

?>