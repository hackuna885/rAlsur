<?php

$con = new SQLite3("../data/riesgos.db");

$tipoUsr = intval($tipoUsuario);

if($tipoUsr === 1){
    // Contador de Consecuencias
    $contadorEstatus = $con -> query("SELECT COUNT(estatusCon) estatusAbierto FROM listaConsecuencias");
    while ($numConsecuenciasAbiertas = $contadorEstatus->fetchArray()) {
	    $estatusAbierto = $numConsecuenciasAbiertas['estatusAbierto'];
	}
    
}else{
    // Contador de Procesos
    $contadorEstatus = $con -> query("SELECT COUNT(estatusCon) estatusAbierto FROM listaConsecuencias WHERE areaCon = '$area'");
    while ($numConsecuenciasAbiertas = $contadorEstatus->fetchArray()) {
	    $estatusAbierto = $numConsecuenciasAbiertas['estatusAbierto'];
	}
}

echo '
<script>
    let estatusAbierto = "'.$estatusAbierto.'"
</script>
';

$con -> close();

?>