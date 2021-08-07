<?php

	$conexion= mysqli_connect("127.0.0.1","root","") or die("no se puede conectar");
	mysqli_select_db($conexion,"sqli") or die("no se encontro la base de datos");
	mysqli_set_charset($conexion,"utf8") or die("no se pudo poner la codificacion");


?>