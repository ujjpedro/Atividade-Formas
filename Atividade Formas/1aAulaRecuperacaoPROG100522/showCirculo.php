<!DOCTYPE html>

<?php
$idCirculo = isset($_GET['idCirculo']) ? $_GET['idCirculo'] : 0;
$riao = isset($_GET['riao']) ? $_GET['riao'] : 0;
$cor = isset($_GET['cor']) ? $_GET['cor'] : "";
$circulo_idTabuleiro = isset($_GET['circulo_idTabuleiro']) ? $_GET['circulo_idTabuleiro'] : 0;
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Circulo</title>

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3>O seu Circulo</h3><hr><br>




<?php  
            if ($acao = "salvar") {
                require_once "classes/Circulo.class.php";

                $circulo = new Circulo($idCirculo,$riao,$cor,$circulo_idTabuleiro);
                echo $circulo;
                echo $circulo->desenha();  
            }
?>

<br>

</body>
</html>