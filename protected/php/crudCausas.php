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



$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$causaCau = (isset($_POST['causaCau'])) ? $_POST['causaCau'] : '';


$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap.' '.$horaCap;


switch ($opcion) {
	case 1:
		$consulta = "INSERT INTO listaCausas (procesoCau, procedimientoCau, causaCau, areaCau, fechaHoraRegCau, idUsuarioCau) VALUES('$nomProceso','$nomProcedimiento', '$causaCau', '$area','$fechaHoraReg','$nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 2:
		$consulta = "UPDATE listaCausas SET causaCau='$causaCau' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		break;

	case 3:
		$consulta = "DELETE FROM listaCausas WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			$consulta = "SELECT id, procesoCau, procedimientoCau, causaCau, areaCau, fechaHoraRegCau, idUsuarioCau, SUM(estatusAbie) AS estatusAbie, SUM(estatusAten) AS estatusAten, SUM(estatusCerr ) AS estatusCerr FROM vListaCausaP WHERE procesoCau = '$nomProceso' AND procedimientoCau = '$nomProcedimiento' AND areaCau = '$area' GROUP BY procesoCau, procedimientoCau, causaCau";
			// $consulta = "SELECT id, procesoCau, procedimientoCau, causaCau, areaCau, fechaHoraRegCau, idUsuarioCau FROM listaCausas";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>