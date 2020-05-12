<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');

session_start();

$nombre = (isset($_SESSION['nombre'])) ? $_SESSION['nombre'] : '';
$correo = (isset($_SESSION['correo'])) ? $_SESSION['correo'] : '';
$correoMd5 = (isset($_SESSION['correoMd5'])) ? $_SESSION['correoMd5'] : '';
$area = (isset($_SESSION['area'])) ? $_SESSION['area'] : '';
$tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : '';

// Valida IMG User
$ruta='../../img/users';
$nomImgUsr = $correoMd5.'.jpg';
$directorio = opendir($ruta);
while ($archivo = readdir($directorio))
{
    $archivo;
    if( $archivo === $nomImgUsr){
        $varImgUsr = 1;
    }
}
if($varImgUsr === 1){
	$imgLoginUsr = 'users/'.$nomImgUsr;
}else{
	$imgLoginUsr = 'usrLogin.svg';
}
// Valida IMG User



if (isset($nombre) && !empty($nombre) &&
	isset($area) && !empty($area) &&
	isset($tipoUsuario) && !empty($tipoUsuario)) {
	
	$ocultar = '';

}else{
	$ocultar = 'style="display: none;"'; // --> recuerda agregar esto en "container"
	echo "<script> window.location='../error/alerta.aspx?error=404';</script>";
}



 ?>

