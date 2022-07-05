<!DOCTYPE html>

<?php
$idTabuleiro = isset($_GET['idTabuleiro']) ? $_GET['idTabuleiro'] : 0;
$lado = isset($_GET['lado']) ? $_GET['lado'] : 0;
?>

<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Tabuleiro</title>
    

</head>
<body>

<?php
require_once "menu.php";
?>

<div class="container-fluid">
<br>
<h3>O seu Tabuleiro</h3><hr><br>




<?php  
            if ($acao = "salvar") {
                require_once "classes/Tabuleiro.class.php";

                $tabuleiro = new Tabuleiro($idTabuleiro,$lado);
                echo $tabuleiro;
            }
?>


<br>

</body>
</html>