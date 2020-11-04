<?php
header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
header('Content-Disposition: attachment; filename=TiemposMaza.xls');
?>
<table>
	<tr> <!-- Es para generar filas -->
		<th style='background-color: #933;
	color: #fff;'> <!-- Es para generar encabezados --> INS DATE </th>
		<th style='background-color: #933;
	color: #fff;'> REM DATE</th>
		<th style='background-color: #933;
	color: #fff;'> S/N MAZA</th>
		<th style='background-color: #933;
	color: #fff;'> LOCATION</th>
		<th style='background-color: #933;
	color: #fff;'> MODEL</th>
		<th style='background-color: #933;
	color: #fff;'> AC</th>
		<th style='background-color: #933;
	color: #fff;'> LG</th>
		<th style='background-color: #933;
	color: #fff;'> POS</th>
		<th style='background-color: #933;
	color: #fff;'> CHG</th>
		<th style='background-color: #933;
	color: #fff;'> FH WHEEL</th>
		<th style='background-color: #933;
	color: #fff;'> CY WHEEL</th>
		<th style='background-color: #933;
	color: #fff;'> INS AC FH</th>
		<th style='background-color: #933;
	color: #fff;'> INS AC CY</th>
		<th style='background-color: #933;
	color: #fff;'> REM AC FH</th>
		<th style='background-color: #933;
	color: #fff;'> REM AC CY</th>
		<th style='background-color: #933;
	color: #fff;'> COMMENTS </th>

	</tr>

	<?php
		require_once("conexion.php");
		$res = $conexion->query("SELECT * FROM movimiento m,tipo t,avion a WHERE m.Matricula=a.Matricula AND a.ID_tipo=t.Id;");
		$contador = 0;
		while($fila = $res->fetch_assoc()){
			if($contador%2==0){
			echo"<tr>";
			echo"<td style='background-color: #add;'> ".$fila["instalacion"]."</td>"; /* td es para crear celdas*/
			echo"<td style='background-color: #add;'> ".$fila["remocion"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["serie"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["lugar"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["Modelo"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["Matricula"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["lg"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["posicion"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["cambio"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["FH_WHEEL"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["CY_WHEEL"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["INS_AC_FH"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["INS_AC_CY"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["REM_AC_FH"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["REM_AC_CY"]."</td>";
			echo"<td style='background-color: #add;'> ".$fila["comments"]."</td>";
			echo"</tr>";
		}else{
			echo"<tr>";
			echo"<td style='background-color: #fff;'> ".$fila["instalacion"]."</td>"; /* td es para crear celdas*/
			echo"<td style='background-color: #fff;'> ".$fila["remocion"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["serie"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["lugar"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["Modelo"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["Matricula"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["lg"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["posicion"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["cambio"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["FH_WHEEL"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["CY_WHEEL"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["INS_AC_FH"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["INS_AC_CY"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["REM_AC_FH"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["REM_AC_CY"]."</td>";
			echo"<td style='background-color: #fff;'> ".$fila["comments"]."</td>";
			echo"</tr>";
		}
		$contador++;
		}
	?>
</table>