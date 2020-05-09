<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
session_start();

include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();

//NOMBRE DE USUARIO
$area = (isset($_SESSION['area'])) ? $_SESSION['area'] : '';
$nombre = (isset($_SESSION['nombre'])) ? $_SESSION['nombre'] : '';


//NUM DE PROCESO
$nomProceso = (isset($_SESSION['nomProceso'])) ? $_SESSION['nomProceso'] : '';
$nomProcedimiento = (isset($_SESSION['nomProcedimiento'])) ? $_SESSION['nomProcedimiento'] : '';
$nomCausa = (isset($_SESSION['nomCausa'])) ? $_SESSION['nomCausa'] : '';



$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$consecuenciaCon = (isset($_POST['consecuenciaCon'])) ? $_POST['consecuenciaCon'] : '';
$probabilidadCon = (isset($_POST['probabilidadCon'])) ? $_POST['probabilidadCon'] : '';
$impactoCon = (isset($_POST['impactoCon'])) ? $_POST['impactoCon'] : '';
$calificaRCon = (isset($_POST['calificaRCon'])) ? $_POST['calificaRCon'] : '';
$estatusCon = (isset($_POST['estatusCon'])) ? $_POST['estatusCon'] : '';
$fechaIdentRCon = (isset($_POST['fechaIdentRCon'])) ? $_POST['fechaIdentRCon'] : '';


$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap.' '.$horaCap;


switch ($opcion) {
	case 1:
		$consulta = "INSERT INTO listaConsecuencias (procesoCon, procedimientoCon, causaCon, consecuenciaCon, probabilidadCon, impactoCon, calificaRCon, estatusCon, fechaIdentRCon, areaCon, fechaHoraRegCon, idUsuarioCon) VALUES('$nomProceso', '$nomProcedimiento', '$nomCausa', '$consecuenciaCon', '$probabilidadCon', '$impactoCon', '$calificaRCon', '$estatusCon', '$fechaIdentRCon', '$area', '$fechaHoraReg', '$nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 2:

		$calificaRCon = $probabilidadCon * $impactoCon;

		$consulta = "UPDATE listaConsecuencias SET consecuenciaCon='$consecuenciaCon', probabilidadCon='$probabilidadCon', impactoCon='$impactoCon', calificaRCon='$calificaRCon', estatusCon='$estatusCon', fechaIdentRCon='$fechaIdentRCon' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		break;

	case 3:
		$consulta = "DELETE FROM listaConsecuencias WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			$consulta = "SELECT id, procesoCon, procedimientoCon, causaCon, consecuenciaCon, probabilidadCon, impactoCon, calificaRCon, estatusCon, fechaIdentRCon, areaCon, fechaHoraRegCon, idUsuarioCon FROM listaConsecuencias WHERE procesoCon = '$nomProceso' AND procedimientoCon = '$nomProcedimiento' AND areaCon = '$area' AND causaCon = '$nomCausa'";
			// $consulta = "SELECT id, procesoCon, procedimientoCon, causaCon, consecuenciaCon, probabilidadCon, impactoCon, calificaRCon, estatusCon, fechaIdentRCon, areaCon, fechaHoraRegCon, idUsuarioCon FROM listaConsecuencias";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>