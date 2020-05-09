<?php include 'seguridad.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Responsables</title>
    <style>
        .centrado-h-v{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .contenidoCard {
            min-height: 195px;
        }
        .collapsible-body {
            padding: .8rem;
        }
    </style>
    <!-- DATOS USUARIO -->
    <?php 
    include 'infoUser.php'; 

    $nomProceso = (isset($_GET['nomProceso'])) ? $_GET['nomProceso'] : '';
    $nomProcedimiento = (isset($_GET['nomProcedimiento'])) ? $_GET['nomProcedimiento'] : '';
    $nomCausa = (isset($_GET['nomCausa'])) ? $_GET['nomCausa'] : '';
    $nomConsec = (isset($_GET['nomConsec'])) ? $_GET['nomConsec'] : '';
    $_SESSION['nomProceso'] = $nomProceso;
    $_SESSION['nomProcedimiento'] = $nomProcedimiento;
    $_SESSION['nomCausa'] = $nomCausa;
    $_SESSION['nomConsec'] = $nomConsec;

    echo '
    <script>
        let nomProceso = "'.$nomProceso.'"
        let nomProcedimiento = "'.$nomProcedimiento.'"
        let nomCausa = "'.$nomCausa.'"
        let nomArea = "'.$area.'"
        let nomConsec = "'.$nomConsec.'"
    </script>
    ';

    ?>
    <!-- DATOS USUARIO -->
</head>
<body>
    
    <div id="app" <?php echo $ocultar; ?>>
        <menu-principal></menu-principal>
        <responsables></responsables>
    </div>

    <script src="../js/vue.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>
    <script src="../js/axios.min.js"></script>
    <script src="../js/chart.js"></script>
    <script src="assets/menu.js"></script>
    <script src="contenido/cont.js"></script>
    <script>
        new Vue({
            el: '#app'
        })

        //Materialize

        window.addEventListener('load', () => {
            document.getElementById('precarga').className = 'hide'
            document.getElementById('contenido').className = 'center animated fadeIn'
        })

        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
</body>
</html>