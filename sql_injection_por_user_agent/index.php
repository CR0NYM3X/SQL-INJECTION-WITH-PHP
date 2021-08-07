<?php

require_once("../cone.php");

echo "<a href='/'>Ir anicio</a><br><br>";


	$resultado=mysqli_query($conexion,"select * from info_cliente where user_agent='".$_SERVER['HTTP_USER_AGENT']."' and ip='".$_SERVER['REMOTE_ADDR']."'");

 	if ($resultado=mysqli_fetch_array($resultado))
 	{
 		 	echo "<strong>Tu USER AGENT:</strong> ".$resultado['user_agent']."<br>";
			echo "<strong>Tu IP:</strong> ".$resultado['ip']."<br><br><br>";


 		echo "Esta es la consulta que se realizo :<br><br><strong>select * from info_cliente where user_agent='<font color='red'>".$_SERVER['HTTP_USER_AGENT']."</font>' and ip='<font color='red'>".$_SERVER['REMOTE_ADDR']."</font>'</strong>";
 	}
 	else
 	{
 		if($resultado=mysqli_query($conexion,"insert into info_cliente value('".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."')"))
 		{
 			echo "<strong>Tu USER AGENT:</strong> ".$_SERVER['HTTP_USER_AGENT']."<br>";
			echo "<strong>Tu IP:</strong> ".$_SERVER['REMOTE_ADDR']."<br><br><br>";

 			echo "<br><br>Se guardo el usuario en la base de datos. Query : <br><br>";
 			echo "<strong>insert into info_cliente value('<font color='red'>".$_SERVER['HTTP_USER_AGENT']."</font>','<font color='red'>".$_SERVER['REMOTE_ADDR']."</font>')</strong>";
 		}
 		else
 		{
 			echo "No se inserto";
 		}

 	}




?>
