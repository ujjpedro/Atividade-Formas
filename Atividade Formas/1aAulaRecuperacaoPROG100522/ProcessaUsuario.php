<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça o seu Cadastro</title>
    <?php
    //var_dump($_POST);
    require "classes/Usuario.class.php";
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

        $idUsuario = isset($_POST['id']) ? $_POST['id'] : 0;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : 0;
        $login = isset($_POST['login']) ? $_POST['login'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";

        $acao = isset($_POST['editar']) ? $_POST['editar'] : "";

        $salvar = isset($_POST['salvar']) ? $_POST['salvar'] : "";

        //var_dump($login);
    ?>
</head>
<body>
    <?php
        require_once "menu.php";
    ?>
<br>
<h3>O seu Cadastro</h3><hr><br>
<br><br>

<?php

require_once "ProcessaUsuario.php";

    if ($acao == "editar") {
        $usuario = new Usuario($idUsuario,$nome,$login,$senha);
        $usuario->editar();

        // echo $usuario;

        header("location:indexUsuario.php");
        //echo "AJAO";
        //echo "Pedro Coelho";
    }

    if ($salvar == "Salvar") {
        $usuario = new Usuario(NULL,$nome,$login,$senha);
        $usuario->inserir();
        //echo $usuario;
        //echo "Salvou";

        header("location:indexUsuario.php");
    }
    

?>
<div class="container-fluid">

</body>
</html>