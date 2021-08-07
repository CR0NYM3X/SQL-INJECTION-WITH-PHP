<?php


echo "<a href='/'>Ir anicio</a><br>";
	require_once("../cone.php");

	if(isset($_COOKIE['usuario']))
	{
 		$resultado=mysqli_query($conexion,"select * from login where usuario='".$_COOKIE["usuario"]."'");

		if ($resultado=mysqli_fetch_array($resultado))
		{
			echo "<strong>BIENVENIDO: </strong>".$resultado['usuario'];

			echo "<br><br>Esta es la consulta que se realizo:<br><br>"."<strong>select * from login where usuario='<font color='red'>".$_COOKIE["usuario"]."</font>'</strong>";
			#setcookie("usuario","", time()-3600,"/"); #para borrar una cookie
		}
		else
		{
			echo "no se encontro el usuario";
			echo "<br><br>Esta es la consulta que se realizo:<br><br>"."<strong>select * from login where usuario='<font color='red'>".$_COOKIE["usuario"]."</font>'</strong>";
		}
	}
	else
	{
		echo "<br>".$_COOKIE['usuario'];
		echo "<br>no se encontro la cookie";
	}
?>