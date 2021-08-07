<!DOCTYPE html>
<html>
<head>
	<title>Indice</title>
</head>
<body>

<h4>SQL Injection </h4>

<ol>
	<li><a >SQL Injection Basic</a></li>
	<li><a target='framename'  target='framename'  href=<?php echo "/login/"; ?>>login Vulnerable</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_por_get/tiendaSinErrores.php?id_producto=1"?>>Sql Injeccion por GET- Sin Mostrar Errores</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_por_get/tienda2.php?id_producto=1"?>>Sql Injeccion por GET sin mostrar Consulta</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_por_get/tiendarandom.php?id_producto=1"?>>Sql Injeccion por GET RANDOM sin mostrar Consulta</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_por_get/tienda.php?id_producto=1"?>>Sql Injeccion por GET</a></li>
	<li><a target='framename'  href="#">Sql Injeccion En query (INSERT, UPDATE, DELETE)</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_por_post/tienda.php"?>>Sql Injeccion por POST</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injection_por_user_agent"?>>SQL injection por User agent</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_cookie"?>>Sql Injeccion por Cookie -> Reconocimieno de usuario por cookie</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sqli_injeccion_get_base64/tienda.php?id_producto=MQ==\""?>>Sql Injeccion por Base64 -> por consultas GET,POST</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_por_busqueda"?>>injeccion con busqueda</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/utilizar_insert_update_sqli/tienda.php"?>>hacer consultas como update,insert SQL injectio -->;<-- </a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/bypass_addslashs/tienda.php"?>>Bypass a addslaches</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/doble_encode_sql/tienda.php?id_producto=%2531"?>>Doble Encode SQL Ijeccion</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_blind/tienda.php?id_producto=1"?>>SQL injeccion BLIND</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_blind/tiendaStatica.php?id_producto=1"?>>SQL injeccion BLIND ESTATICA</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_blind/tiendarandom.php?id_producto=1"?>>SQL injeccion BLIND CON UN NUMERO ALEATORIO EN HTML Y VULNERABLE A XSS</a></li>
	<li><a target='framename'  href=<?php echo $_SERVER["REQUEST_URI"]."/127.0.0.1/sql_injeccion_blind/tiendarandomSinMostrarConsulta.php?id_producto=1"?>>SQL injeccion BLIND CON UN NUMERO ALEATORIO EN HTML Y SIN MOSTRAR CONSULTA</a></li>
	<li><a target='framename'  href="/127.0.0.1/sql_injeccion_error/tienda.php?id_producto=1"?>>SQL injeccion Base Errror</a></li>
	<li><a target='framename'  href="/127.0.0.1/bypass_pdo_prepare/tienda.php?id_producto=1"?>>bypass pdo prepare</a></li>
	<li><a target='framename'  href="#">select * from login where 1=0 and 'sdasd'=contraseña; Variables alreves</a></li>


<!-- 
	<li><a href="">Tipos de comentados<\a><\li>
	<li><a href="">Saber que Base de datos es<\a><\li>
	<li><a href=""><\a>Aprobechando reconocimiento de usuario en pagina para Fuerza Bruta<\li>
	<li><a href=""><\a>Aprobechando Validacion de intentos o sin captchat<\li>
	<li><a href="#">Aprendiendo evacion de WAF -> bypass<\a><\li>
	<li><a href="#">hacer script para obtener valor de un md5<\a><\li>
	<li><a href="#">hacer script para obtener paginas sql injeccion<\a><\li>
	<li><a href="#">Robar codigo fuente con sqli injeccion, convirtiendo un archivo php en txt e ingresandolo a una carpeta y consultarlo por url<\a><\li>
	<li><a href="#">subir WEBSHELL injecction<\a><\li>
	<li><a href="#">Base de datos sin privilegios<\a><\li>
	<li><a href="#">Base de datos con privilegios<\a><\li>
	<li><a href="#"><\a>縗' OR 1=1 \*<\li>






    Error Based Injections (Union Select)
        String
        Intiger

    Error Based Injections (Double Injection Based)

    BLIND Injections: 1.Boolian Based 2.Time Based

    Update Query Injection.

    Insert Query Injections.

    Header Injections. 1.Referer based. 2.UserAgent based. 3.Cookie based.

    Second Order Injections

    Bypassing WAF
        Bypassing Blacklist filters Stripping comments Stripping OR & AND Stripping SPACES and COMMENTS Stripping UNION & SELECT
        Impidence mismatch

    Bypass addslashes()

    Bypassing mysql_real_escape_string. (under special conditions)

    Stacked SQL injections.

    Secondary channel extraction

-->

</ol>


</body>
</html>