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
$nomConsec = (isset($_SESSION['nomConsec'])) ? $_SESSION['nomConsec'] : '';
$cali = (isset($_SESSION['cali'])) ? $_SESSION['cali'] : '';
$estatus = (isset($_SESSION['estatus'])) ? $_SESSION['estatus'] : '';



$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nomRespAtenRes = (isset($_POST['nomRespAtenRes'])) ? $_POST['nomRespAtenRes'] : '';


$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap.' '.$horaCap;


switch ($opcion) {
	case 1:
		$consulta = "INSERT INTO listaNomRespo (procesoRes, procedimientoRes, causaRes, consecuenciaRes, calificaRRes, estatusRes, nomRespAtenRes, areaRes, fechaHoraRegRes, idUsuarioRes) VALUES('$nomProceso', '$nomProcedimiento', '$nomCausa', '$nomConsec', '$cali', '$estatus', '$nomRespAtenRes', '$area', '$fechaHoraReg', '$nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 2:

		$calificaRCon = $probabilidadCon * $impactoCon;

		$consulta = "UPDATE listaNomRespo SET nomRespAtenRes='$nomRespAtenRes' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		break;

	case 3:
		$consulta = "DELETE FROM listaNomRespo WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			$consulta = "SELECT id, procesoRes, procedimientoRes, causaRes, consecuenciaRes, calificaRRes, estatusRes, nomRespAtenRes, areaRes, fechaHoraRegRes, idUsuarioRes FROM listaNomRespo WHERE procesoRes = '$nomProceso' AND procedimientoRes = '$nomProcedimiento' AND causaRes = '$nomCausa' AND consecuenciaRes = '$nomConsec' AND areaRes = '$area' AND calificaRRes = '$cali' AND estatusRes = '$estatus'";
			// $consulta = "SELECT id, procesoRes, procedimientoRes, causaRes, consecuenciaRes, calificaRRes, estatusRes, nomRespAtenRes, areaRes, fechaHoraRegRes, idUsuarioRes FROM listaNomRespo";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>