<?php include 'seguridad.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- git -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/sweetalert2.min.css">
    <link rel="stylesheet" href="../css/animate.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Procedimientos</title>
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
    $_SESSION['nomProceso'] = $nomProceso;

    echo '
    <script>
        let nomProceso = "'.$nomProceso.'"
    </script>
    ';

    ?>
    <!-- DATOS USUARIO -->
</head>
<body>
    
    <div id="app" <?php echo $ocultar; ?>>
        <menu-principal></menu-principal>
        <procedimientos></procedimientos>
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