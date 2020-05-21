<?php

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");
date_default_timezone_set('America/Mexico_City');

session_start();

$area = (isset($_SESSION['area'])) ? $_SESSION['area'] : '';
$tipoUsuario = (isset($_SESSION['tipoUsuario'])) ? $_SESSION['tipoUsuario'] : '';

// echo '[';

$array = array();

$con = new SQLite3("../data/riesgos.db");

// $contadorNotifica = $con -> query("SELECT COUNT(fechaCumpliAcc) AS accPen,fechaCumpliAcc FROM listaAcciones GROUP BY fechaCumpliAcc  ORDER BY fechaCumpliAcc ");

// $contadorNotifica = $con -> query("SELECT procesoAcc, procedimientoAcc,accionesAcc, fechaCumpliAcc FROM listaAcciones ORDER BY procesoAcc, procedimientoAcc, fechaCumpliAcc");

if ($tipoUsuario === 1) {
    $contadorNotifica = $con -> query("SELECT procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc,accionesAcc, fechaCumpliAcc FROM listaAcciones WHERE estatusAcc = 'Abierto' ORDER BY procesoAcc, procedimientoAcc, fechaCumpliAcc");
}else{
    $contadorNotifica = $con -> query("SELECT procesoAcc, procedimientoAcc, causaAcc, consecuenciaAcc, calificaRAcc, estatusAcc, nomRespAtenAcc,accionesAcc, fechaCumpliAcc FROM listaAcciones WHERE estatusAcc = 'Abierto' AND areaAcc = '$area' ORDER BY procesoAcc, procedimientoAcc, fechaCumpliAcc");
}
    while ($numNotifica = $contadorNotifica->fetchArray()) {
        $procesoAcc = $numNotifica['procesoAcc'];
        $procedimientoAcc = $numNotifica['procedimientoAcc'];
        $causaAcc = $numNotifica['causaAcc'];
        $consecuenciaAcc = $numNotifica['consecuenciaAcc'];
        $calificaRAcc = $numNotifica['calificaRAcc'];
        $estatusAcc = $numNotifica['estatusAcc'];
        $nomRespAtenAcc = $numNotifica['nomRespAtenAcc'];
        $accionesAcc = $numNotifica['accionesAcc'];
        $fechaCumpliAcc = $numNotifica['fechaCumpliAcc'];

        $fechaTermino = $fechaCumpliAcc;
        $anoTermino = substr($fechaTermino, 0, 4);
        $mesTermino = substr($fechaTermino, 5, 2);
        $diaTermino = substr($fechaTermino, 8, 2);

        $fechaActual = date('Y-m-d');
        $anoActual = date('Y');
        $mesActual = date('m');
        $diaActual = date('d');
        

        //Saber si  Año de Termino es bisiesto
        if(ctype_digit($anoTermino/4)){
            // echo $anoTermino.' Soy Bisiesto';
            $varBisiestoT = 1;
        }else{
            // echo $anoTermino.' No soy bisiesto';
            $varBisiestoT = 0;
        }

        //Saber si  Año Actual es bisiesto
        if(ctype_digit($anoActual/4)){
            // echo $anoActual.' Soy Bisiesto';
            $varBisiestoA = 1;
        }else{
            // echo $anoActual.' No soy bisiesto';
            $varBisiestoA = 0;
        }

        // echo '<br><br>';
        $varAno = $anoTermino - $anoActual;
        $varMeses = $mesTermino - $mesActual;
        $varDias = $diaTermino - $diaActual;

        if($varAno < 0){
            $contadorDiasRestantes = 'Vencido';
        }elseif ($varAno === 0) {
            if($varMeses < 0){
                $contadorDiasRestantes = 'Vencido';
            }elseif($varMeses === 0){
                if($varDias < 0){
                    $contadorDiasRestantes = 'Vencido';
                }elseif ($varDias === 0) {
                    $contadorDiasRestantes = 'hoy vence';
                }else{
                    // echo 'dias';
                    $dias = $diaTermino - $diaActual;
                    if($dias === 1){
                        $contadorDiasRestantes = 'Falta: '.$dias.' día';
                    }else{
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                    }
                }
            }else{
                // echo 'meses y días';
                $sumarMeses = 0;
                $elMes = $mesActual+1;
                
                for ($i=$elMes; $i < $mesTermino; $i++) { 
                    switch ($i) {
                        case 1:
                            $diasMesTer = 31;
                            break;
                        case 2:
                            if ($varBisiestoA === 1) {
                                $diasFeb = 29;
                            }else{
                                $diasFeb = 28;
                            }
                            $diasMesTer = $diasFeb;
                            break;
                        case 3:
                            $diasMesTer = 31;
                            break;
                        case 4:
                            $diasMesTer = 30;
                            break;
                        case 5:
                            $diasMesTer = 31;
                            break;
                        case 6:
                            $diasMesTer = 30;
                            break;
                        case 7:
                            $diasMesTer = 31;
                            break;
                        case 8:
                            $diasMesTer = 31;
                            break;
                        case 9:
                            $diasMesTer = 30;
                            break;
                        case 10:
                            $diasMesTer = 31;
                            break;
                        case 11:
                            $diasMesTer = 30;
                            break;
                        case 12:
                            $diasMesTer = 31;
                            break;
                    }
                    $sumarMeses = $sumarMeses+$diasMesTer;
                    
                }
                

                switch ($mesActual) {
                    case 01:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 02:
                        if ($varBisiestoA === 1) {
                            $diasFeb = 29;
                        }else{
                            $diasFeb = 28;
                        }
                        $dias = ($diasFeb - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 03:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 04:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 05:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 06:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 07:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 08:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 09:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 10:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 11:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 12:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                }
            }
        }else{
            if($varAno === 1){
                // echo 'Solo días del año corriente + los dias del siguiente año';
                $sumarMeses = 0;
                $elMes = $mesActual+1;
                
                for ($i=$elMes; $i <= 12; $i++) { 
                    switch ($i) {
                        case 1:
                            $diasMesTer = 31;
                            break;
                        case 2:
                            if ($varBisiestoA === 1) {
                                $diasFeb = 29;
                            }else{
                                $diasFeb = 28;
                            }
                            $diasMesTer = $diasFeb;
                            break;
                        case 3:
                            $diasMesTer = 31;
                            break;
                        case 4:
                            $diasMesTer = 30;
                            break;
                        case 5:
                            $diasMesTer = 31;
                            break;
                        case 6:
                            $diasMesTer = 30;
                            break;
                        case 7:
                            $diasMesTer = 31;
                            break;
                        case 8:
                            $diasMesTer = 31;
                            break;
                        case 9:
                            $diasMesTer = 30;
                            break;
                        case 10:
                            $diasMesTer = 31;
                            break;
                        case 11:
                            $diasMesTer = 30;
                            break;
                        case 12:
                            $diasMesTer = 31;
                            break;
                    }
                    $sumarMeses = $sumarMeses+$diasMesTer;
                    
                }


                $sumarMesesSAno = 0;
                
                for ($i=1; $i < $mesTermino; $i++) { 
                    switch ($i) {
                        case 1:
                            $diasMesSAno = 31;
                            break;
                        case 2:
                            if ($varBisiestoT === 1) {
                                $diasFeb = 29;
                            }else{
                                $diasFeb = 28;
                            }
                            $diasMesSAno = $diasFeb;
                            break;
                        case 3:
                            $diasMesSAno = 31;
                            break;
                        case 4:
                            $diasMesSAno = 30;
                            break;
                        case 5:
                            $diasMesSAno = 31;
                            break;
                        case 6:
                            $diasMesSAno = 30;
                            break;
                        case 7:
                            $diasMesSAno = 31;
                            break;
                        case 8:
                            $diasMesSAno = 31;
                            break;
                        case 9:
                            $diasMesSAno = 30;
                            break;
                        case 10:
                            $diasMesSAno = 31;
                            break;
                        case 11:
                            $diasMesSAno = 30;
                            break;
                        case 12:
                            $diasMesSAno = 31;
                            break;
                    }
                    $sumarMesesSAno = $sumarMesesSAno+$diasMesSAno;
                    
                }

                switch ($mesActual) {
                    case 01:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 02:
                        if ($varBisiestoA === 1) {
                            $diasFeb = 29;
                        }else{
                            $diasFeb = 28;
                        }
                        $dias = ($diasFeb - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 03:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 04:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 05:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 06:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 07:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 08:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 09:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 10:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 11:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                    case 12:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno;
                        $contadorDiasRestantes = 'Faltan: '.$dias.' días';
                        break;
                }



            }else{
                $cantidadAnos = $varAno-1;
                $diasXAno = $cantidadAnos * 365;
                // echo $diasXAno.' días mas + los días del año corriente + los dias del siguiente año'    ;
                
                
                $sumarMeses = 0;
                $elMes = $mesActual+1;
                
                for ($i=$elMes; $i <= 12; $i++) { 
                    switch ($i) {
                        case 1:
                            $diasMesTer = 31;
                            break;
                        case 2:
                            if ($varBisiestoA === 1) {
                                $diasFeb = 29;
                            }else{
                                $diasFeb = 28;
                            }
                            $diasMesTer = $diasFeb;
                            break;
                        case 3:
                            $diasMesTer = 31;
                            break;
                        case 4:
                            $diasMesTer = 30;
                            break;
                        case 5:
                            $diasMesTer = 31;
                            break;
                        case 6:
                            $diasMesTer = 30;
                            break;
                        case 7:
                            $diasMesTer = 31;
                            break;
                        case 8:
                            $diasMesTer = 31;
                            break;
                        case 9:
                            $diasMesTer = 30;
                            break;
                        case 10:
                            $diasMesTer = 31;
                            break;
                        case 11:
                            $diasMesTer = 30;
                            break;
                        case 12:
                            $diasMesTer = 31;
                            break;
                    }
                    $sumarMeses = $sumarMeses+$diasMesTer;
                    
                }


                $sumarMesesSAno = 0;
                
                for ($i=1; $i < $mesTermino; $i++) { 
                    switch ($i) {
                        case 1:
                            $diasMesSAno = 31;
                            break;
                        case 2:
                            if ($varBisiestoT === 1) {
                                $diasFeb = 29;
                            }else{
                                $diasFeb = 28;
                            }
                            $diasMesSAno = $diasFeb;
                            break;
                        case 3:
                            $diasMesSAno = 31;
                            break;
                        case 4:
                            $diasMesSAno = 30;
                            break;
                        case 5:
                            $diasMesSAno = 31;
                            break;
                        case 6:
                            $diasMesSAno = 30;
                            break;
                        case 7:
                            $diasMesSAno = 31;
                            break;
                        case 8:
                            $diasMesSAno = 31;
                            break;
                        case 9:
                            $diasMesSAno = 30;
                            break;
                        case 10:
                            $diasMesSAno = 31;
                            break;
                        case 11:
                            $diasMesSAno = 30;
                            break;
                        case 12:
                            $diasMesSAno = 31;
                            break;
                    }
                    $sumarMesesSAno = $sumarMesesSAno+$diasMesSAno;
                    
                }

                switch ($mesActual) {
                    case 01:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 02:
                        if ($varBisiestoA === 1) {
                            $diasFeb = 29;
                        }else{
                            $diasFeb = 28;
                        }
                        $dias = ($diasFeb - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 03:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 04:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 05:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 06:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 07:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 08:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 09:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 10:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 11:
                        $dias = (30 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                    case 12:
                        $dias = (31 - $diaActual) + $diaTermino + $sumarMeses + $sumarMesesSAno + $diasXAno;
                        $contadorDiasRestantes ='Faltan: '.$dias.' días';
                        break;
                }
            }
        }

    $baseNotifica = array("procesoAcc"=>$procesoAcc, "procedimientoAcc"=>$procedimientoAcc, "causaAcc"=>$causaAcc, "consecuenciaAcc"=>$consecuenciaAcc,  "calificaRAcc"=>$calificaRAcc,  "estatusAcc"=>$estatusAcc,  "nomRespAtenAcc"=>$nomRespAtenAcc, "accionesAcc"=>$accionesAcc, "fechaCumpliAcc"=>$fechaCumpliAcc, "notaEspecial"=>$contadorDiasRestantes);

    $array[] = $baseNotifica; //Almacena los datos en un arrar array_push($array, $baseNotifica); 
    
        

    }

    header('Content-Type: application/json');
    echo json_encode($array);
    
    
    // echo ']';




?>