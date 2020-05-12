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
    <title>Inicio</title>
    <style>
        .centrado-h-v{
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .contenidoCard {
            min-height: 195px;
        }
    </style>
    <!-- DATOS USUARIO -->
    <?php include 'infoUser.php'; ?>
    <!-- DATOS USUARIO -->
    
    <?php include 'graficasHome.php'; ?>
</head>
<body>
    
    <div id="app" <?php echo $ocultar; ?>>
        <menu-principal></menu-principal>
        <home-panel></home-panel>
    </div>

    <script src="../js/vue.js"></script>
    <script src="../js/materialize.min.js"></script>
    <script src="../js/sweetalert2.min.js"></script>
    <script src="../js/axios.min.js"></script>
    <script src="../js/chart.js"></script>
    <script src="assets/menu.js"></script>
    <script src="contenido/home.js"></script>
    <script>
        new Vue({
            el: '#app'
        })

        //Materialize

        window.addEventListener('load', () => {
            document.getElementById('precarga').className = 'hide'
            document.getElementById('contenido').className = 'center animated fadeInUp'
        })

        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
        });
    </script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
        labels: ['Critico', 'Alto', 'Medio', 'Bajo'],
        datasets: [{
        label: 'Riesgos',
        backgroundColor: ['#D32F2F','#F57C00', '#FBC02D', '#43A047'],
        data: <?php echo $graficaPrincipal;?>
        }]
        },

        // Configuration options go here
        options: {}
        });
        
    </script>
</body>
</html>