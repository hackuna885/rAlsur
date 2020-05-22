<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');
session_start();

// PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
// PHPMailer

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
$estatusAcc = (isset($_POST['estatusAcc'])) ? $_POST['estatusAcc'] : '';
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

		//inicia Correo
		$mail = new PHPMailer(true);

		try {
				//Server settings
				$mail->CharSet = 'UTF-8';

				$mail->isSMTP();

				$mail->Host       = 'smtp.flockmail.com';  // Specify main and backup SMTP servers
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Username   = 'oliver.velazquez@corsec.com.mx';                     // SMTP username
				$mail->Password   = 'Oliver#123';                               // SMTP password
				$mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
				$mail->Port       = 587;                                    // TCP port to connect to

				//PARA PHP 5.6 Y POSTERIOR
				$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );

				//Recipients
				$mail->setFrom('oliver.velazquez@corsec.com.mx', 'Acciones de Mitigación');
				$mail->addAddress('oliver.velazquez@corsec.com.mx');     //Correo de Salida

				// Content
				$mail->isHTML(true);
				$mail->Subject = $area.' - '.$fechaHoraReg;
				$mail->Body    = '
								<h3 style="color: #0d47a1;">'.$accionesAcc.'</h3>
								<p style="color: #64b5f6 ;"><b style="color: #0d47a1;">Proceso: </b>'.$nomProceso.'<br>
									<b style="color: #0d47a1;">Procedimiento: </b>'.$nomProcedimiento.'<br>
									<b style="color: #0d47a1;">Causa: </b>'.$nomCausa.'<br>
									<b style="color: #0d47a1;">Consecuencia: </b>'.$nomConsec.'<br>
									<b style="color: #0d47a1;">Responsable de atención: </b>'.$nomRespAtenRes.'<br>
									<b style="color: #0d47a1;">Acción: </b>'.$accionesAcc.'<br>
									<b style="color: #0d47a1;">Fecha de seguimiento: </b>'.$fechaSeguiAcc.'<br>
									<b style="color: #0d47a1;">Fecha de cumplimiento: </b><span style="color: #e53935;">'.$fechaCumpliAcc.'</span><br>
																<b style=" color: #0d47a1;">Área: </b>'.$area.'<br>
										<b style="color: #0d47a1;">Fecha de alta: </b>'.$fechaHoraReg.'<br>
										<b style="color: #0d47a1;">Elaborado por: </b>'.$nombre.'<br>
								</p>
								<a href="https://www.corsec.com.mx/rAlsurDos/acciones/pro.app?nomProceso='.$nomProceso.'&nomProcedimiento='.$nomProcedimiento.'&nomCausa='.$nomCausa.'&nomConsec='.$nomConsec.'&cali='.$cali.'&estatus='.$estatus.'&nomRespAtenRes='.$nomRespAtenRes.'">https://www.corsec.com.mx/rAlsurDos/acciones/pro.app?nomProceso='.$nomProceso.'&nomProcedimiento='.$nomProcedimiento.'&nomCausa='.$nomCausa.'&nomConsec='.$nomConsec.'&cali='.$cali.'&estatus='.$estatus.'&nomRespAtenRes='.$nomRespAtenRes.'</a>
				
				';

			$mail->send();
		} catch (Exception $e) {
			
		}
		//inicia Correo


		break;

	case 2:
		$consulta = "UPDATE listaAcciones SET accionesAcc='$accionesAcc', estatusAcc='$estatusAcc', fechaSeguiAcc='$fechaSeguiAcc', fechaCumpliAcc='$fechaCumpliAcc' WHERE id='$id'";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		$data = $resultado->fetchAll(PDO::FETCH_ASSOC);

		//Cosulta el estado CERRADO para actualizar listaConsecuencias 
		$conDos = new SQLite3("../data/riesgos.db");
		$verificaEstatusCompleto = $conDos -> query("SELECT procesoAcc, procedimientoAcc, causaAcc, estatusAcc, accionesAcc, totalElementos, elementos FROM vListaAccionesP WHERE accionesAcc = '$accionesAcc' AND estatusAcc = 'Cerrado'");
			while ($veriEstatusC = $verificaEstatusCompleto->fetchArray()) {
				$procesoAcc = $veriEstatusC['procesoAcc'];
				$procedimientoAcc = $veriEstatusC['procedimientoAcc'];
				$causaAcc = $veriEstatusC['causaAcc'];
				$totalElementos = $veriEstatusC['totalElementos'];
				$elementos = $veriEstatusC['elementos'];
			}

			if ($totalElementos === $elementos) {
				$csActulizarConsecuencias = $conDos -> query("UPDATE listaConsecuencias SET estatusCon = 'Cerrado' WHERE procesoCon='$procesoAcc' AND procedimientoCon='$procedimientoAcc' AND causaCon='$causaAcc'");
			}
		$conDos -> close();
		


		break;

	case 3:
		$consulta = "DELETE FROM listaAcciones WHERE id='$id'";	
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
		break;

	case 4:
			$consulta = "SELECT id, procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc, accionesAcc, fechaSeguiAcc, fechaCumpliAcc, areaAcc, fechaHoraRegAcc, idUsuarioAcc FROM listaAcciones WHERE procesoAcc = '$nomProceso' AND procedimientoAcc = '$nomProcedimiento' AND causaAcc = '$nomCausa' AND consecuenciaAcc = '$nomConsec' AND calificaRAcc = '$cali' AND nomRespAtenAcc = '$nomRespAtenRes'";
			// $consulta = "SELECT id, procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc, accionesAcc, fechaSeguiAcc, fechaCumpliAcc, areaAcc, fechaHoraRegAcc, idUsuarioAcc FROM listaAcciones WHERE procesoAcc = '$nomProceso' AND procedimientoAcc = '$nomProcedimiento' AND causaAcc = '$nomCausa' AND consecuenciaAcc = '$nomConsec' AND calificaRAcc = '$cali' AND estatusAcc = '$estatus' AND nomRespAtenAcc = '$nomRespAtenRes'";
			// $consulta = "SELECT id, procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc, accionesAcc, fechaSeguiAcc, fechaCumpliAcc, areaAcc, fechaHoraRegAcc, idUsuarioAcc FROM listaAcciones";
	        $resultado = $conexion->prepare($consulta);
	        $resultado->execute();
	        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);

		break;
}

echo json_encode($data);

$conexion = NULL;

 ?>