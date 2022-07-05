<!DOCTYPE html>

<?php

    $idCubo = isset($_GET['idCubo']) ? $_GET['idCubo'] : 0;
    $cor = isset($_GET['cor']) ? $_GET['cor'] : 0;
    $id = isset($_GET['id']) ? $_GET['id'] : "";

?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Cubo</title>

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3>O seu Cubo</h3><hr><br>




<?php  
            if ($acao = "salvar") {
                require_once "classes/Cubo.class.php";

                $cubo = new Cubo($idCubo,$cor,$id);
                echo $cubo;
                echo $cubo->desenha();  
            }
?>

<br>

</body>
</html>