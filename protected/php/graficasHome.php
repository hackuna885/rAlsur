<?php

$con = new SQLite3("../data/riesgos.db");

$tipoUsr = intval($tipoUsuario);

if($tipoUsr === 1){
    // Contador de Procesos
    $contadorProcesos = $con -> query("SELECT COUNT(proceso) AS cuantosProcesos FROM listaProcesos");
    while ($numProcesos = $contadorProcesos->fetchArray()) {
	    $cuantosProcesos = $numProcesos['cuantosProcesos'];
	}
    // Contador de Procedimientos
    $contadorProcedimientos = $con -> query("SELECT COUNT(procedimientoPro) AS cuantosProcedimientos FROM listaProcedimientos");
    while ($numProcedimientos = $contadorProcedimientos->fetchArray()) {
	    $cuantosProcedimientos = $numProcedimientos['cuantosProcedimientos'];
	}
    // Contador de Consecuencias Bajo
    $contadorConsecBajo = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecBajo FROM listaConsecuencias WHERE calificaRCon <= 10");
    while ($numConsecBajo = $contadorConsecBajo->fetchArray()) {
	    $cuantosConsecBajo = $numConsecBajo['cuantosConsecBajo'];
	}
    // Contador de Consecuencias Medios
    $contadorConsecMedios = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecMedios FROM listaConsecuencias WHERE calificaRCon BETWEEN 11 AND 20");
    while ($numConsecMedios = $contadorConsecMedios->fetchArray()) {
	    $cuantosConsecMedios = $numConsecMedios['cuantosConsecMedios'];
	}
    // Contador de Consecuencias Altos
    $contadorConsecAltos = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecAltos FROM listaConsecuencias WHERE calificaRCon BETWEEN 21 AND 30");
    while ($numConsecAltos = $contadorConsecAltos->fetchArray()) {
	    $cuantosConsecAltos = $numConsecAltos['cuantosConsecAltos'];
	}
    // Contador de Consecuencias Criticos
    $contadorConsecCriticos = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecCriticos FROM listaConsecuencias WHERE calificaRCon > 30");
    while ($numConsecCriticos = $contadorConsecCriticos->fetchArray()) {
	    $cuantosConsecCriticos = $numConsecCriticos['cuantosConsecCriticos'];
	}
    
}else{
    // Contador de Procesos
    $contadorProcesos = $con -> query("SELECT COUNT(proceso) AS cuantosProcesos FROM listaProcesos WHERE area = '$area'");
    while ($numProcesos = $contadorProcesos->fetchArray()) {
	    $cuantosProcesos = $numProcesos['cuantosProcesos'];
    }
    // Contador de Procedimientos
    $contadorProcedimientos = $con -> query("SELECT COUNT(procedimientoPro) AS cuantosProcedimientos FROM listaProcedimientos WHERE areaPro = '$area'");
    while ($numProcedimientos = $contadorProcedimientos->fetchArray()) {
	    $cuantosProcedimientos = $numProcedimientos['cuantosProcedimientos'];
    }
    // Contador de Consecuencias Bajo
    $contadorConsecBajo = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecBajo FROM listaConsecuencias WHERE calificaRCon <= 10 AND areaCon = '$area'");
    while ($numConsecBajo = $contadorConsecBajo->fetchArray()) {
	    $cuantosConsecBajo = $numConsecBajo['cuantosConsecBajo'];
	}
    // Contador de Consecuencias Medios
    $contadorConsecMedios = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecMedios FROM listaConsecuencias WHERE calificaRCon BETWEEN 11 AND 20 AND areaCon = '$area'");
    while ($numConsecMedios = $contadorConsecMedios->fetchArray()) {
	    $cuantosConsecMedios = $numConsecMedios['cuantosConsecMedios'];
	}
    // Contador de Consecuencias Altos
    $contadorConsecAltos = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecAltos FROM listaConsecuencias WHERE calificaRCon BETWEEN 21 AND 30 AND areaCon = '$area'");
    while ($numConsecAltos = $contadorConsecAltos->fetchArray()) {
	    $cuantosConsecAltos = $numConsecAltos['cuantosConsecAltos'];
	}
    // Contador de Consecuencias Criticos
    $contadorConsecCriticos = $con -> query("SELECT COUNT(calificaRCon) AS cuantosConsecCriticos FROM listaConsecuencias WHERE calificaRCon > 30 AND areaCon = '$area'");
    while ($numConsecCriticos = $contadorConsecCriticos->fetchArray()) {
	    $cuantosConsecCriticos = $numConsecCriticos['cuantosConsecCriticos'];
	}
}

$graficaPrincipal = '['.$cuantosConsecCriticos.','.$cuantosConsecAltos.','.$cuantosConsecMedios.','.$cuantosConsecBajo.']';

echo '
<script>
    let cuantosProcesos = "'.$cuantosProcesos.'"
    let cuantosProcedimientos = "'.$cuantosProcedimientos.'"
    let cuantosConsecBajo = "'.$cuantosConsecBajo.'"
    let cuantosConsecMedios = "'.$cuantosConsecMedios.'"
    let cuantosConsecAltos = "'.$cuantosConsecAltos.'"
    let cuantosConsecCriticos = "'.$cuantosConsecCriticos.'"
</script>
';

$con -> close();

?>