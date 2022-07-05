<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Quadrado</title>
    <?php
    //var_dump($_POST);
    require "classes/Quadrado.class.php";
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $tabuleiro_idTabuleiro = isset($_POST['tabuleiro_idTabuleiro']) ? $_POST['tabuleiro_idTabuleiro'] : 0;

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
<h3>O seu Quadrado</h3><hr><br>
<br><br>
<!-- <style>
        .quadradinho{
            /* position: absolute;
            margin-left: 50%; */
            background-color: <?php echo $cor?>;
            width: <?php echo $lado?>vh;
            height: <?php echo $lado?>vh;
        }
    </style>

<div class="quadradinho"></div> -->

<br>

<?php

require_once "Processa.php";

    if ($acao == "editar") {
        
        echo "Id:".$id."<br>
            Lado: ".$lado."<br>
            cor: ".$cor."<br>
            Id Tabuleiro: ".$tabuleiro_idTabuleiro;
        
        $quadrado = new Quadrado($id,$lado,$cor,$tabuleiro_idTabuleiro);
        $quadrado->editar();

        header("location:index.php"); 

        //echo "Pedro Coelho";
    }

    if ($salvar == "Salvar") {
        $quadrado = new Quadrado(NULL,$lado,$cor,$tabuleiro_idTabuleiro);
        $quadrado->inserir();

        header("location:index.php"); 

        //echo $quadrado;
        //echo "Salvou";
    }
    

?>
<div class="container-fluid">

</body>
</html>