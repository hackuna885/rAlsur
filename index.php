<?php 

error_reporting(E_ALL ^ E_DEPRECATED);
header("Content-Type: text/html; Charset=UTF-8");

session_start();
session_destroy();

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Riesgos</title>
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <style>
        html {
        height: 100%;
        }

        body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100%;
        }
    </style>
</head>
<body class="blue darken-3">
	<div id="app">
        <login></login>
    </div>
	

    <script src="js/materialize.min.js"></script>
    <script src="js/vue.js"></script>
    <script src="assets/login.app"></script>
    
</body>
</html>