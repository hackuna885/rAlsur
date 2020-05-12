<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

session_start();

if (isset($_POST['txtUsr']) && !empty($_POST['txtUsr']) &&
	isset($_POST['txtPwd']) && !empty($_POST['txtPwd'])) {

	$txtUsr = (isset($_POST['txtUsr'])) ?  md5($_POST['txtUsr']) : '';
	$txtPwd = (isset($_POST['txtPwd'])) ?  md5($_POST['txtPwd']) : '';

	$con = new SQLite3("../../protected/data/riesgos.db");
	$cs = $con -> query("SELECT * FROM registroUsr WHERE correoMd5 = '$txtUsr'");



	while ($resul = $cs -> fetchArray()) {

		$nombre = $resul['nombre'];
		$area = $resul['area'];
		$correo = $resul['correo'];
		$correoMd5 = $resul['correoMd5'];
		$passDecrypt = $resul['passDecrypt'];
		$tipoUsuario = $resul['tipoUsuario'];
		$usrActivo = $resul['usrActivo'];


	}


	/*VALIDACIÓN DE USUARIO*/

	$correoMd5 = (isset($correoMd5)) ?  $correoMd5 : '';
	$passDecrypt = (isset($passDecrypt)) ?  $passDecrypt : '';

	if ($txtUsr === $correoMd5) {

		/*VALIDACIÓN DE PASSWORD*/
		
		if ($txtPwd === $passDecrypt) {

			/*VALIDACIÓN DE USUARIO ACTIVO*/
			if ($usrActivo === '1') {

				$_SESSION['nombre'] = $nombre;
				$_SESSION['correo'] = $correo;
				$_SESSION['correoMd5'] = $correoMd5;
				$_SESSION['area'] = $area;
				$_SESSION['tipoUsuario'] = $tipoUsuario;

				echo "<script> window.location='../inicio/home.app';</script>";

				$con -> close();
			}else{
				echo "<script> window.location='../error/alerta.app?error=usrNoActivo';</script>";
				$con -> close();
			}

			
			
		}else{
			// ERROR DE PASSWORD
			echo "<script> window.location='../error/alerta.app?error=pswNoValido';</script>";
			$con -> close();
		}

	}else{
		// ERROR DE USUARIO
		echo "<script> window.location='../error/alerta.app?error=usrNoValido';</script>";
		$con -> close();
	}
	
	
}else{
	// FLATAN CAMPOS
	echo "<script> window.location='../error/alerta.app?error=faltanCampos';</script>";
}

 ?>