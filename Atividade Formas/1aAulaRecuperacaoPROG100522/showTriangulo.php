<!DOCTYPE html>

<?php
$idTriangulo = isset($_GET['idTriangulo']) ? $_GET['idTriangulo'] : 0;
$baseTriangulo = isset($_GET['baseTriangulo']) ? $_GET['baseTriangulo'] : 0;
$ladoTriangulo1 = isset($_GET['ladoTriangulo1']) ? $_GET['ladoTriangulo1'] : 0;
$ladoTriangulo2 = isset($_GET['ladoTriangulo2']) ? $_GET['ladoTriangulo2'] : 0;
$cor = isset($_GET['cor']) ? $_GET['cor'] : "";
$triangulo_idTabuleiro = isset($_GET['triangulo_idTabuleiro']) ? $_GET['triangulo_idTabuleiro'] : 0;
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Triangulo</title>

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3>O seu Triangulo</h3><hr><br>




<?php  
            if ($acao = "salvar") {
                require_once "AutoLoad.class.php";

                $triangulo = new Triangulo($idTriangulo,$baseTriangulo,$ladoTriangulo1,$ladoTriangulo2,$cor,$triangulo_idTabuleiro);
                echo $triangulo;
                echo $triangulo->desenha();  
            }
?>

<br>

</body>
</html>