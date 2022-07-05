<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Tabuleiro</title>
    <?php
    //var_dump($_POST);
    require "classes/Tabuleiro.class.php";
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

        $idTabuleiro = isset($_POST['idTabuleiro']) ? $_POST['idTabuleiro'] : 0;
        $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;

        $acao = isset($_POST['editar']) ? $_POST['editar'] : "";

        $salvar = isset($_POST['salvar']) ? $_POST['salvar'] : "";

        //var_dump($cor);
    ?>
</head>
<body>
    <?php
        require_once "menu.php";
    ?>
<br>
<h3>O seu Tabuleiro</h3><hr><br>
<br><br>

<br>

<?php

require_once "ProcessaTabuleiro.php";

    if ($acao == "editar") {
        
        echo "Id:".$idTabuleiro."<br>
            Lado: ".$lado;
        
        $tabuleiro = new Tabuleiro($idTabuleiro,$lado);
        $tabuleiro->editar();

        header("location:indexTabuleiro.php");  

        //echo "Pedro Coelho";
    }

    if ($salvar == "Salvar") {
        $tabuleiro = new Tabuleiro(NULL,$lado);
        $tabuleiro->inserir();
        //echo $tabuleiro;
        //echo "Salvou";

        header("location:indexTabuleiro.php");  
    }
    

?>
<div class="container-fluid">

</body>
</html>