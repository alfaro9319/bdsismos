<?php
    require ('../class/xajax_core/xajax.inc.php');
    $xajax=new xajax();
    $xajax->configure('javascript URI', '../class/');
    //date_default_timezone_set('America/Lima');
	session_start();
	function userlogin($form){
	 	$objResponse = new xajaxResponse();
 		$usuarios=array("indeci","dhn","rpp");
 		$claves=array("indeci","hidrografia","radioprogramas");
 			
 		$idx_usuario = array_search($form["usuario"],$usuarios);
 		$idx_clave = array_search($form["clave"],$claves);
 		
		if ($form["usuario"]==$usuarios[$idx_usuario] and $form["clave"]==$claves[$idx_clave]){
			$_SESSION["login"]=1;
			//$objResponse->alert (print_r($_SESSION,TRUE));
			$objResponse->redirect('ultimosismo.php');
			
		}
		else{
			$objResponse->alert("Error de usuario o clave");
		}
	 	return $objResponse;
	}
 
 	$xajax->registerFunction('userlogin');
	$xajax->processRequest();
	
	require ("../class/ClassPlantilla.php");	 
	$Contenido=new Plantilla("tpl/login");
	$Contenido->asigna_variables(array(
		"ajax" => $xajax->printJavascript()
	));
	$ContenidoString = $Contenido->muestra();
	echo $ContenidoString;

	 
?>