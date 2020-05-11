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
$nomRespAtenRes = (isset($_SESSION['nomRespAtenRes'])) ? $_SESSION['nomRespAtenRes'] : '';



$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';


$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$accionesAcc = (isset($_POST['accionesAcc'])) ? $_POST['accionesAcc'] : '';
$fechaSeguiAcc = (isset($_POST['fechaSeguiAcc'])) ? $_POST['fechaSeguiAcc'] : '';
$fechaCumpliAcc = (isset($_POST['fechaCumpliAcc'])) ? $_POST['fechaCumpliAcc'] : '';


$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap.' '.$horaCap;


switch ($opcion) {
	case 1:
		$consulta = "INSERT INTO listaAcciones (procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc, accionesAcc, fechaSeguiAcc, fechaCumpliAcc, areaAcc, fechaHoraRegAcc, idUsuarioAcc) VALUES('$nomProceso', '$nomProcedimiento', '$nomCausa', '$nomConsec', '$cali', '$estatus', '$nomRespAtenRes', '$accionesAcc', '$fechaSeguiAcc', '$fechaCumpliAcc', '$area', '$fechaHoraReg', '$nombre')";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 2:
		$consulta = "UPDATE listaAcciones SET accionesAcc='$accionesAcc', fechaSeguiAcc='$fechaSeguiAcc', fechaCumpliAcc='$fechaCumpliAcc' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		break;

	case 3:
		$consulta = "DELETE FROM listaAcciones WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			$consulta = "SELECT id, procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc, accionesAcc, fechaSeguiAcc, fechaCumpliAcc, areaAcc, fechaHoraRegAcc, idUsuarioAcc FROM listaAcciones WHERE procesoAcc = '$nomProceso' AND procedimientoAcc = '$nomProcedimiento' AND causaAcc = '$nomCausa' AND consecuenciaAcc = '$nomConsec' AND calificaRAcc = '$cali' AND estatusAcc = '$estatus' AND nomRespAtenAcc = '$nomRespAtenRes'";
			// $consulta = "SELECT id, procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc, accionesAcc, fechaSeguiAcc, fechaCumpliAcc, areaAcc, fechaHoraRegAcc, idUsuarioAcc FROM listaAcciones";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>