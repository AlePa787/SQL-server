<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		*{
			margin: 0;
			padding: 0;
			border:0;
		}
		body{
			background-color: rgb(164,163,164);
			margin: 1em;
		}
		section.tipo{
			display: inline-block;
			text-align: center;
			margin-bottom: 2em;
			width: 22%;
		}
		section.tipo input[type="submit"],input[type="button"]{
			background-color: white;
			color: rgb(244,172,10);
			font-size: 1.3em;
			padding: 0.4em;
			width: 90%
		}
		section.avion{
			background-color: rgba(255,255,255,1);
			display: inline-block;
			text-align:center;
			width: 300px;
			box-shadow: 2px 3px 5px 5px white;
			border-radius: 20px;
			margin-right: 20px;
			margin-bottom: 40px;
		}
		section.avion input[type="image"]{
			border-radius: 20px;
			max-width: 100%;
			min-width: 100%;
			max-height: 200px;
			min-height: 200px;
		}
		#agregar input[type="submit"]{
			width: 20%;
			border-radius: 50%;
		}
		#eliminar input[type="submit"]{
			width: 20%;
			border-radius: 50%;
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
		.eliminar{
			text-align: center;
			background-color: white;
			border-radius: 15px;
			padding: 1em;
			margin: 0 auto;
			width: 40%;
		}
		.eliminar input{
			border: 1px solid lightblue;
			padding:0.2em;
			font-size: 0.8em;
			margin-top: 0.7em;
		}
		.eliminar input[type="submit"]{
			background-color: black;
			color: white;
		}
		select{
			border: 1px solid black;
		}
		.flecha input[type="image"]{
			width: 50px;
		}
		input[type="radio"]{
			margin:0.8em;
			border:0px;
			width: 3%;
			height: 1.2em;
		}
		#reporte{
			position:  fixed; /*Es para despreciar las posiciones de los demas elementos*/
			bottom: 0;
			right:0;
			width: 10%;
		}
		#reporte img{
			max-width: 100%;
		}
		#cerrar{
			position:  fixed; /*Es para despreciar las posiciones de los demas elementos*/
			bottom: 0;
			left:0;
			width: 5%;
		}
		#cerrar img{
			max-width: 100%;
		}
		table{
			margin-top: 10px;
			width: 100%;
		}
		th{
			background-color: white;
		}
		td{
			padding:10px;
			text-align: center;
		}
	</style>
</head>
<body>
<?php 
		session_start();
		if(isset($_POST["avion"])){
			$_SESSION["seccion"] = "posicion";
			$_SESSION["avion"] = $_POST["avion"];
			header("Location: home.php");
		}
		if(isset($_POST["tipo"])){
			$_SESSION["seccion"] = "avion";
			$_SESSION["tipo"] = $_POST["tipo"];
			header("Location: home.php");
		}
		if(isset($_POST["regAvion"])){
			$_SESSION["seccion"]="avion";
			header("Location:home.php");
		}
		if(isset($_POST["regTipo"])){
			$_SESSION["seccion"]="tipo";
			header("Location:home.php");
		}
		if(isset($_SESSION["seccion"]) && $_SESSION["seccion"]=="avion"){
				require_once("avion.php");
		}
		if(isset($_SESSION["seccion"]) && $_SESSION["seccion"]=="posicion"){
			require_once("posicion.php");
		}
		if (!isset($_SESSION["seccion"]) || $_SESSION["seccion"]=="tipo") {
			require_once("tipo.php");
		}
		
?>
<section id="cerrar">
	<a href="cerrar.php">
		<img src="cerrar.png">
		
	</a>
</section>
</body>
</html>