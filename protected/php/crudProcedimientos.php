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



$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$procedimientoPro = (isset($_POST['procedimientoPro'])) ? $_POST['procedimientoPro'] : '';
$descripDelRiesgoPro = (isset($_POST['descripDelRiesgoPro'])) ? $_POST['descripDelRiesgoPro'] : '';
$factDeRiesgoPro = (isset($_POST['factDeRiesgoPro'])) ? $_POST['factDeRiesgoPro'] : '';


$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap.' '.$horaCap;


switch ($opcion) {
	case 1:
		$consulta = "INSERT INTO listaProcedimientos (procesoPro, procedimientoPro, descripDelRiesgoPro, factDeRiesgoPro, areaPro, fechaHoraRegPro, idUsuarioPro) VALUES('$nomProceso','$procedimientoPro', '$descripDelRiesgoPro', '$factDeRiesgoPro', '$area','$fechaHoraReg','$nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 2:
		$consulta = "UPDATE listaProcedimientos SET procedimientoPro='$procedimientoPro', descripDelRiesgoPro='$descripDelRiesgoPro', factDeRiesgoPro='$factDeRiesgoPro' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		break;

	case 3:
		$consulta = "DELETE FROM listaProcedimientos WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			// $consulta = "SELECT id, procesoPro, procedimientoPro, descripDelRiesgoPro, factDeRiesgoPro, areaPro, fechaHoraRegPro,idUsuarioPro FROM listaProcedimientos WHERE procesoPro = '$nomProceso' AND areaPro = '$area'";
			$consulta = "SELECT id, procesoPro, procedimientoPro, descripDelRiesgoPro, factDeRiesgoPro, areaPro, fechaHoraRegPro, idUsuarioPro, SUM(estatusAbie) AS estatusAbie, SUM(estatusAten) AS estatusAten, SUM(estatusCerr ) AS estatusCerr FROM vListaProcedimientosP WHERE procesoPro = '$nomProceso' AND areaPro = '$area' GROUP BY procesoPro, procedimientoPro";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>