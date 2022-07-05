<!DOCTYPE html>

<?php
$idRetangulo = isset($_GET['idRetangulo']) ? $_GET['idRetangulo'] : 0;
$alturaRetangulo = isset($_GET['alturaRetangulo']) ? $_GET['alturaRetangulo'] : 0;
$baseRetangulo = isset($_GET['baseRetangulo']) ? $_GET['baseRetangulo'] : 0;
$cor = isset($_GET['cor']) ? $_GET['cor'] : "";
$retangulo_idTabuleiro = isset($_GET['retangulo_idTabuleiro']) ? $_GET['retangulo_idTabuleiro'] : 0;
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Retangulo</title>

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3>O seu Retangulo</h3><hr><br>




<?php  
            if ($acao = "salvar") {
                require_once "AutoLoad.class.php";

                $retangulo = new Retangulo($idRetangulo,$alturaRetangulo,$baseRetangulo,$cor,$retangulo_idTabuleiro);
                echo $retangulo;
                echo $retangulo->desenha();  
            }
?>

<br>

</body>
</html>