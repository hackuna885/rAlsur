<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');

include_once 'conexion.php';

$objeto = new Conexion();
$conexion = $objeto->Conectar();


$_POST = json_decode(file_get_contents("php://input"), true);

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
$nombre = (isset($_POST['nombre'])) ? $_POST['nombre'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$correo = (isset($_POST['correo'])) ? $_POST['correo'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$tipoUsuario = (isset($_POST['tipoUsuario'])) ? $_POST['tipoUsuario'] : '';
$usrActivo = (isset($_POST['usrActivo'])) ? $_POST['usrActivo'] : '';

$nombre = mb_strtoupper($nombre, 'UTF-8');
$userMd5 = md5($nombre);
$area = mb_strtoupper($area, 'UTF-8');
$correoMd5 = md5($correo);
$pwCode = md5($password);


$fechaCap = date('d-m-Y');
$horaCap = date('g:i:s a');
$fechaHoraReg = $fechaCap.' '.$horaCap;


switch ($opcion) {
	case 1:
		$consulta = "INSERT INTO registroUsr (nombre, userMd5, area, correo, correoMd5, password, passDecrypt, usrNavega, usrSO, usrVerSO, usrFechaHoraReg, tipoUsuario, usrActivo) VALUES('$nombre', '$userMd5', '$area', '$correo', '$correoMd5', '$password', '$pwCode', '', '', '', '$fechaHoraReg', '$tipoUsuario', 1)";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 2:
		$consulta = "UPDATE registroUsr SET nombre='$nombre', userMd5='$userMd5', area='$area', correo='$correo', correoMd5='$correoMd5', password='$password', passDecrypt='$pwCode', tipoUsuario='$tipoUsuario' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
		break;

	case 3:
		$consulta = "DELETE FROM registroUsr WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			$consulta = "SELECT id, nombre, userMd5, area, correo, correoMd5, password, passDecrypt, usrNavega, usrSO, usrVerSO, usrFechaHoraReg, tipoUsuario, usrActivo FROM registroUsr";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>