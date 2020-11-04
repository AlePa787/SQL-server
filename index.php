<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			background-color: rgb(244,172,10);
			text-align: center;
		}
		img{
			max-width: 50%;
			border-radius: 30px;
		}
		form{
			background-color:gray;
			border-radius: 20px;
			max-width: 35%;
			margin: 0 auto;
		}
		input{
			margin: 0.7em;
		}
		input[type="submit"]{
			background-color: #000;
			color:white;
			padding: 0.4em;
			border-radius: 5px;
		}

	</style>
</head>
<body>
	<h1>Mazas</h1>
	<form action="" method="post">
		Usuario:<br> <input type="text" name="usuario"> <br>
		Password:<br> <input type="password" name="password"> <br>
		<input type="submit" name="ingresar" value="Login">
	</form>
	<?php 

		if (isset($_POST["ingresar"])) {
			require_once("conexion.php");
			$u = $_POST["usuario"];
			$p = $_POST["password"];
			$res = $conexion->query("SELECT * FROM usuario WHERE usuario='$u' AND password='$p'");
			if ($res->num_rows==1) {
				$fila = $res->fetch_assoc();
				$tipo = $fila["tipo"];
				session_start();
				$_SESSION["permiso"] = $tipo;
				header("Location: home.php");
			}else{
				echo "Usuario o Contraseña incorrectos";
			}
		}
	 ?>
	 <br><img src="otro logo.jpg">
</body>
</html>